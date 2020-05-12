# Ark Explorer

<p align="center" style="max-width:300px">
    <img src="/ARKExplorer.png" />
</p>

> Simple blockchain explorer for the ARK blockchain, using Livewire, Alpine.js & TailwindCSS.

# Development setup

This project is based on Laravel 7

[Laravel Homestead](https://laravel.com/docs/7.x/homestead) virtual machine (vagrant) contains all the system requirements to run the project, and the following installation steps
are based on `homestead`.

For custom installation, please refer to Laravel's [official guide](https://laravel.com/docs/7.x#server-requirements) to install and setup Laravel 7 and composer.

## Homestead installation using Vagrant

Install the Homestead Vagrant box.

```
$ vagrant box add laravel/homestead
```

### 1. Setup `Homestead.yaml`

Download installation script.

    $ git clone https://github.com/laravel/homestead.git homestead

Run homestead initialization script to generate `Homestead.yaml`.

    $ cd homestead
    $ bash init.sh

Open the generated Homestead.yaml and change `sites` property to point to `/home/vagrant/ark-explorer/public`

Example of `sites` section in Homestead.yaml file:


```yml
sites:
    - map: homestead.test
      to: /home/vagrant/ark-explorer/public
```

Start vagrant machine (make sure you are still in `homestead` directory).

    $ vagrant up --provision

###### For more details refer to Laravel's official [documentation](https://laravel.com/docs/7.x/homestead#configuring-homestead) on configuring homestead.

### 2. Project installation

After `vagrant up` that we have the machine operating, connect to machine by running:

    $ vagrant ssh

Download the repo.

    vagrant@homestead~/$ git clone https://github.com/goga-m/ark-explorer.git
    vagrant@homestead~/$ cd ark-explorer

Install dependencies.
    
    vagrant@homestead~/ark-explorer$ composer install

Create `.env` file

    vagrant@homestead~/ark-explorer$ cp .env.example .env
   
Generate key.

    vagrant@homestead~/ark-explorer$ php artisan key:generate

You can now visit the `http://homestead.test` or the ip that is set in `Homestead.yaml` (default to `http://192.168.10.10`)

## License


[MIT](LICENSE) © [ARK Ecosystem](https://ark.io)
