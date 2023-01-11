cp namecheapddns.php namecheapddns.sh /sbin
chmod +x /sbin/namecheapddns.sh

if grep -q Namecheap /etc.defaults/ddns_provider.conf; then
        #Nothing
else
        echo -e "[Namecheap]" >> /etc.defaults/ddns_provider.conf
        echo -e "\tmodulepath=/sbin/namecheapddns.sh" >> /etc.defaults/ddns_provider.conf
        echo -e "\tqueryurl=https://dynamicdns.park-your-domain.com/" >> /etc.defaults/ddns_provider.conf
fi
