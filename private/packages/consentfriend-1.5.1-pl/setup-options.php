<?php
/**
 * Setup options
 *
 * @package consentfriend
 * @subpackage build
 *
 * @var modX $modx
 * @var array $options
 */

$output = '';
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
        $output .= '<h2>Install ConsentFriend</h2>
        <p>ConsentFriend will be installed. Please review the install options carefully.</p><br>';

        $output .= '<div><label for="mode">Install the ConsentFriend demo service/purpose data:</label>
                        <select id="mode" name="mode">
                            <option value="skip" selected="selected">Skip</option>
                            <option value="setup">Install</option>
                            <option value="essential">Essential only</option>
                        </select>
                    </div>
                    <br><br>';

        break;
    case xPDOTransport::ACTION_UPGRADE:
        $output .= '<h2>Upgrade ConsentFriend</h2>
        <p>ConsentFriend will be upgraded. Please review the install options carefully.</p><br>';

        $output .= '<div><label for="mode">Update the ConsentFriend service/purpose data:</label>
                        <select id="mode" name="mode">
                            <option value="skip" selected="selected">Skip</option>
                            <option value="replace">Replace existing (Reset default services - delete custom services)</option>.
                            <option value="append">Append new (Append not existing default services - keep all other services)</option>
                            <option value="update">Update all (Reset default services - keep custom services)</option>
                        </select>
                    </div>
                    <br><br>';

        break;
    case xPDOTransport::ACTION_UNINSTALL:
        break;
}

return $output;
