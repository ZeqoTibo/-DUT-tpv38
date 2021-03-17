php composer.phar config cache-dir --unset
php composer.phar config cache-dir "%USERPROFILE%\symfony\cache"
php composer.phar config vendor-dir --unset
php composer.phar config vendor-dir "%USERPROFILE%\symfony\vendor"
php composer.phar config bin-dir --unset
php composer.phar config bin-dir "%USERPROFILE%\symfony\bin"
php composer.phar install