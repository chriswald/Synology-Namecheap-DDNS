Description
===========
This repository contains the scripts and setupt instructions necessary to configure a Synology NAS to use Namecheap's own DDNS service to automatically update an A + Dynamic DDNS Record with the public IP address of the Synology server. It does not describe how to enable DDNS for a host within Namecheap.

Note
====
This setup may periodically be wiped out (maybe on major upgrades?) and need to be reimplemented.

Setup
=====
 1. Copy `namecheapddns.php` and `namecheapddns.sh` to `/sbin`
 2. Use `chmod` to make `namecheapddns.sh` executable
 3. Use `vi` to edit `/etc.defaults/ddns_provider.conf` and add the following text:
    ```
    [Namecheap]
        modulepath=/sbin/namecheapddns.sh
        queryurl=https://dynamicdns.park-your-domain.com/
    ```
 4. In DSM, open Control Panel > External Access > DDNS
 5. Click Add
 6. Choose Namecheap as the service provider
 7. In Hostname enter the domain name purchased from Namecheap (eg `example.com`)
 8. In Username/Email enter the subdomain to dynamically update (eg `subdomain` to update `subdomain.example.com`). See Namecheap DDNS documentation for special values that can be entered here.
 9. In Password/Key provide the Dynamic DNS Password provided by Namecheap when Dynamic DNS was enabled.
 10. Test the connection. The status should come back Normal.
