## Group Name Reservation Plugin

The Group Name Reservation Plugin is used with COmanage Registry to only allow Platform Administrators and CO Administrators to create groups with names that have a specified format. 

The plugin should be installed/enabled in the [traditional way](https://spaces.at.internet2.edu/display/COmanage/Installing+and+Enabling+Registry+Plugins).

Once enabled, a Platform or CO admin can create a Group Name Reservation from the CO Configuration menu. 

The configurable fields are: 

 * Description
 * Status - whether this validator is enabled or disabled
 * Name Format - the regular expression describing the reserved regular group name format. See the [PHP Manual](https://www.php.net/manual/en/reference.pcre.pattern.syntax.php) for Regular Expression syntax. 
 * Error Message - the error message that should be displayed if a person who is not an administrator tries to create a group with a name that matches the reserved format pattern. 

Multiple Group Name Reservations may be active at the same time. 

The Group Name Reservation only checks regular group names at Save time. It does not flag regular group names that have already been created. However,an active reservation will cause an error to be displayed if an already created regular group is edited and, upon save, the name matches the reserved pattern and the person editing the group is not an administrator for the platform or for the current CO. 

The Group Name Validator and the Group Name Reservation plugins should not be used on the same CO at the same time. 
