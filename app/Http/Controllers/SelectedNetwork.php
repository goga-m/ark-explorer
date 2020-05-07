<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Wrapper controller for storing/retrieving
 * selected network name (Mainnet, Devnet).
 *
 * Stores chain/network values in session.
 *
 */
class SelectedNetwork extends Controller
{
    protected $defaultNetwork = 'Mainnet';

    protected $networks;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

      // Network info (urls), hardcoded.
      $this->networks = collect([
        [ 'name' => 'Mainnet', 'url' => 'https://explorer.ark.io/api'],
        [ 'name' => 'Devnet', 'url' => 'https://dexplorer.ark.io/api']
      ]);

    }
    /**
     * Set default selected network in session
     * if not exists.
     * @return void
     */
    public function setDefaultIfNotExists()
    {
        if (!session()->has('selectedNetwork')) {
          session()->put('selectedNetwork', $this->defaultNetwork);
        }
    }

    /**
     * Get the name only of the selected network.
     * @return string
     */
    public function getName()
    {
        return session()->get('selectedNetwork');
    }

    /**
     * Set the selectedNetwork.
     * Set only if $network name is contained in available networks.
     *
     * @param integer $networkName Mainnet/Devnet
     * @return void
     */
    public function set($networkName)
    {
      if($this->networks->contains('name', $networkName)) {
        session()->put('selectedNetwork', $networkName);
      }
    }

    /**
     * Get the url of the selected network (for API requests).
     * @return string
     */
    public function getUrl()
    {
        $selected = session()->get('selectedNetwork');
        return $this->networks
                    ->where('name', '===', $selected)
                    ->pluck('url')
                    ->first();
    }
}
