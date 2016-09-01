Vagrant.configure(2) do |config|


    config_json = JSON.parse(File.read("config.json"))

    # config.vm.base_mac = "<hash>"

    config.vm.box = config_json["vm"]["box"]

    config.vm.network :private_network, ip: config_json["vm"]["ip"]
    config.vm.network :public_network
    config.ssh.username = config_json["vm"]["ssh"]["user"]
    config.ssh.password = config_json["vm"]["ssh"]["password"]

    config_json["vm"]["forwarded_ports"].each do |folder|
        config.vm.network "forwarded_port", guest: folder["guest"], host: folder["host"]
    end

    config.vm.provider :virtualbox do |vb|
        config_json["vm"]["synced_folders"].each do |folder|
          config.vm.synced_folder folder["host_path"], folder["guest_path"] , type: "nfs"
        end
    end

end
