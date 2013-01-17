<?php

/**
 * Unsubscribe class file
 *
 * Copyright 2013 by BobRay <http://bobsguides.com>
 * Created on 01/10/2013
 *
 * Subscribe is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Subscribe is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Subscribe; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package subscribe
 */

/** Description: Methods to provide a CAN-SPAM Act compliant
 * unsubscribe/manage preferences link in emails; requires Subscribe
 * and Login packages to be installed.
 *
 * The only property is &method, which specifies the hashing method;
 * default: 'hashing.modPBKDF2'
 */

class Unsubscribe {
    /** @var $modx modX */
    public $modx;
    /**
     * @var
     */
    protected $secretKey;
    protected $method;
    /** @var $props array */
    public $props;

    function __construct(&$modx, &$config = array()) {
        $this->modx =& $modx;
        $this->props =& $config;
    }

    public function init() {
        $this->secretKey = $this->modx->getOption('sbs_secret_key', null,'5QLKlHLJWEFlCNWMQktO4eSwZHZZ87U3i2U%2B9VNq2bw%3D' );
        $this->method = $this->modx->getOption('method', $this->props, 'hashing.modPBKDF2');

    }

    public function my_debug($message, $clear = false) {
        /* @var $chunk modChunk */
        $chunk = $this->modx->getObject('modChunk', array('name' => 'debug'));

        if (!$chunk) {
            $chunk = $this->modx->newObject('modChunk', array('name' => 'debug'));
            $chunk->save();
            $chunk = $this->modx->getObject('modChunk', array('name' => 'debug'));
        }
        if ($clear) {
            $content = '';
        } else {
            $content = $chunk->getContent();
        }
        $content .= $message;
        $chunk->setContent($content);
        $chunk->save();
    }

    /**
     * @param $email string - actual user email address
     * @return string - encoded email address
     */
    public function encodeEmail($email) {
        return (urlencode(base64_encode($email)));
    }

    /**
     * @param $email string - encoded user email address
     * @return string - actual user email address
     */
    public function decodeEmail($email) {
        return (urldecode(base64_decode($email)));
    }

    /**
     * Creates an encoded key based on data from the User Profile
     * If this is cracked, nothing of much value is exposed --
     * Does not use username or user ID.
     *
     * @param $profile modUserProfile - User Profile object
     * @return string
     */
    public function encodeKey($profile) {
        /* @var $profile modUserProfile */
        $fullName = $profile->get('fullname');
        $email = $profile->get('email');
        if (empty($fullName)) {
            /* use truncated email if fullname is empty */
            $fullName = substr($email, 0, -1);
        }
        $this->my_debug('In EncodeKey');
        $this->my_debug('Email: ' . $email);
        $this->my_debug('Full Name: ' . $fullName);
        /* ID of the profile, not the user - useless if cracked */
        $ik = $profile->get('id');
        $this->my_debug('IK: ' . $ik);
        $hash = $this->getHash($this->modx, $ik . $this->secretKey . $email . $fullName, $email);
        $this->my_debug('KEY: ' . $hash);
        return $this->getHash($this->modx, $ik . $this->secretKey . $email . $fullName, $email);
    }

    /**
     * Authenticates user based on data from $_GET params
     *
     * @param $profile modUserProfile - User Profile object
     * @param $key string - key created by encodeKey()
     * @return bool - true if user is authenticated.
     */
    public function userMatch($profile, $key) {
        /* @var $profile modUserProfile */
        // echo '<br /> EncKey: ' . $this->encodeKey($profile) . ' --- Received Key: ' . $key;
        return $this->encodeKey($profile) === $key;
    }

    /**
     * Creates a URL for use in unsubscribe/manage prefs link in emails.
     *
     * @param $url string - URL of page containing the unsubscribe snippet tag
     * @param $encodedEmail string - email address encoded with encodeEmail()
     * @param $key string - key created by encodeKey()
     * @return string - full unsubscribe/manage prefs URL for email message
     */
    public function createUrl($url, $profile) {
        /* @var $profile modUserProfile */
        $encodedEmail = $this->encodeEmail($profile->get('email'));
        $key = $this->encodeKey($profile);
        return $url . '?ue=' . $encodedEmail . '&uk=' . $key;
    }

    /**
     * Get full user and data only for authenticated users
     * based on $_GET params
     *
     * @param $encodedEmail string - encoded email (&ue) from $_GET param
     * @param $key string - Key (&uk) from $_GET param
     * @return array - array containing $user and $profile objects or
     *                 empty array if user is not found
     */
    public function getUserData($encodedEmail, $key) {
        $userData = array();
        $email = $this->decodeEmail($encodedEmail);
        $profiles = $this->modx->getCollection('modUserProfile', array('email' => $email));

        /* Find the actual user from among those with matching
           email addresses */
        foreach ($profiles as $profile) {
            /* @var $profile modUserProfile */
            if ($this->userMatch($profile, $key)) {
                $user = $this->modx->getObject('modUser', $profile->get('internalKey'));
                $userData['user'] =& $user;
                $userData['profile'] =& $profile;
                break;
            }
        }
        unset($profiles);
        return $userData;
    }

    /**
     * Returns a URL-encoded hash of submitted key
     *
     * @param $modx modX - $modx object
     * @param $key - string to be encoded
     * @param $salt - salt for hash
     * @return string - urlEncoded hash of key
     */
    protected function getHash(&$modx, $key, $salt) {
        /* @var $modx modX */
        $options['salt'] = $salt;
        $modx->getService('hashing', 'hashing.modHashing');
        $hash = $modx->hashing->getHash('', $this->method)->hash($key, $options);
        /* $_GET would mangle these if we didn't replace them */
        $hash = $data = str_replace(array('+','/','='),
            array('-','_',), $hash);
        return rawurlencode($hash);
    }
}
