#!/bin/bash

# Core Setup
wp core update --allow-root

# wp core install \
# --url='http://localhost' \
# --title='SITE_NAME' \
# --admin_user='admin' \
# --admin_password='password' \
# --admin_email='dev@example.com' \
# --allow-root

# Localization to Japanese
wp language core install ja --activate --allow-root

# Timezone and Date/Time Format
wp option update timezone_string 'Asia/Tokyo' --allow-root
wp option update date_format 'Y-m-d' --allow-root
wp option update time_format 'H:i' --allow-root

# Set the site's catchphrase to an empty value
wp option update blogdescription '' --allow-root

# Delete unnecessary default plugins
wp plugin delete hello.php --allow-root
wp plugin delete akismet --allow-root

# Install and activate necessary plugins
wp plugin install wp-multibyte-patch --activate --allow-root
wp plugin install classic-editor --activate --allow-root
wp plugin update --all --allow-root

# Activate a custom theme named 'my-theme'
wp theme activate my-theme --allow-root

# Delete default themes
wp theme delete twentytwentyfour --allow-root
wp theme delete twentytwentyfive --allow-root

# Update permalinks
wp option update permalink_structure /%category%/%postname%/ --allow-root

# Options
wp option set thumbnail_crop 0 --allow-root
wp option set thumbnail_size_w 0 --allow-root
wp option set thumbnail_size_h 0 --allow-root
wp option set medium_size_w 0 --allow-root
wp option set medium_size_h 0 --allow-root
wp option set medium_large_size_w 0 --allow-root
wp option set medium_large_size_h 0 --allow-root
wp option set large_size_w 0 --allow-root
wp option set large_size_h 0 --allow-root
wp option set uploads_use_yearmonth_folders 0 --allow-root
wp option set default_pingback_flag 0 --allow-root
wp option set default_ping_status 0 --allow-root
wp option set default_comment_status 0 --allow-root
wp option set require_name_email 0 --allow-root
wp option set show_comments_cookies_opt_in 0 --allow-root
wp option set thread_comments 0 --allow-root
wp option set comments_notify 0 --allow-root
wp option set moderation_notify 0 --allow-root
wp option set comment_previously_approved 0 --allow-root
wp option set show_avatars 0 --allow-root

