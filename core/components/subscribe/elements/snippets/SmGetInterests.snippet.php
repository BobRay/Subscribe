<?php
/**
 * Subscribe
 * Copyright 2012 Bob Ray <http://bobsguides/com>
 *
 * Subscribe is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * Subscribe is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Subscribe; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package subscribe
 * @author Bob Ray <http://bobsguides/com>
 *
 * @version Version 1.0.0 Beta-1
 * 3/3/12
 *
 * Description Get user interests from Register form and save them in the 'comment'
 * field of the User Profile
 *
 * /

/** Properties
 * @package subscribe

 */

/* @var $ints string */
/* @var $profile modUserProfile */
/* @var $output string */


$ints = $hook->getValue('interests');

$profile = $hook->getValue('register.profile');

if ($profile) {
   $profile->set('comment', implode(',', $ints) );
   if (! $profile->save()) {
       $output .= 'could not save profile';
   };

} else  {
   $output .= 'No Profile';
   die($output);

}

return true;