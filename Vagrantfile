VAGRANTFILE_API_VERSION = "2"

# https://atlas.hashicorp.com/puppetlabs

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "puppetlabs/ubuntu-16.04-64-nocm"
  config.vm.network :private_network, ip: "192.168.100.88"
  config.vm.hostname = "defesas"

  config.vm.provider :virtualbox do |v|
    v.name = "rede100_ip88_defesas"
    v.memory = 256
    v.cpus = 1
    v.customize ["modifyvm", :id, "--groups", "/rede100"]
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    v.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
    v.customize ["modifyvm", :id, "--ioapic", "on"]
  end
end
