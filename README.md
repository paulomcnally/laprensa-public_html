LaPrensa
========

La Prensa Website source code

maintained by: 
Juan Alvarez
David Menache
Shawn Crowe

Added password cache to server repo but this wont work for new server deploys:
git config --global credential.helper cache
#git config --global credential.helper 'cache --timeout=3600' //1hr
git config --global credential.helper 'cache --timeout=86400' //24hrs
