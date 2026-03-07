#jeffery russell 12-20-2020
# docker file to run this website in a container
FROM nginx

COPY ./ /usr/share/nginx/html/
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 4001