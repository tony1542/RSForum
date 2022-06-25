FROM httpd:2.4.51

COPY RSForumVue.apache.conf /usr/local/apache2/conf/RSForumVue.apache.conf

RUN echo "Include /usr/local/apache2/conf/RSForumVue.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf