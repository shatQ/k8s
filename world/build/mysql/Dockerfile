FROM mysql:5.7

ADD https://downloads.mysql.com/docs/world.sql.gz /docker-entrypoint-initdb.d/

RUN gzip -d /docker-entrypoint-initdb.d/world.sql.gz
RUN chown mysql /docker-entrypoint-initdb.d/world.sql
