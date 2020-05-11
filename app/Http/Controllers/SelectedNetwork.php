<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Wrapper controller for storing/retrieving
 * selected network name (Mainnet, Devnet).
 *
 * Stores chain/network values in session.
 */
class SelectedNetwork extends Controller
{
    /**
     * Set default selected network in session
     * if not set.
     *
     * @return void
     */
    public static function setDefaultIfNotExists()
    {
        $defaultNetwork = 'Mainnet';
        if (!session()->has('selectedNetwork')) {
            session()->put('selectedNetwork', $defaultNetwork);
        }
    }

    /**
     * Get the name only of the selected network.
     *
     * @return string
     */
    public static function getName()
    {
        $defaultNetwork = 'Mainnet';
        $selected = session()->get('selectedNetwork');

        if($selected) return $selected;
        else return $defaultNetwork;
    }

    /**
     * Set the selectedNetwork.
     * Set only if $network name is contained in available networks.
     *
     * @param string $networkName Mainnet/Devnet
     * @return void
     */
    public static function set($networkName)
    {
        if(self::getNetworks()->contains('name', $networkName)) {
            session()->put('selectedNetwork', $networkName);
        }
    }

    /**
     * Get the url of the selected network.
     *
     * @return string
     */
    public static function getUrl()
    {
        $selected = session()->get('selectedNetwork');
        return self::getNetworks()
            ->where('name', '===', $selected)
            ->pluck('url')
            ->first();
    }

    /**
     * Get the available (used) networks.
     *
     * @return mixed
     */
    private static function getNetworks()
    {
        return collect([
            [ 'name' => 'Mainnet', 'url' => 'https://explorer.ark.io/api'],
            [ 'name' => 'Devnet', 'url' => 'https://dexplorer.ark.io/api']
        ]);
    }

}