FROM php:7.4-cli

WORKDIR /app

COPY site/ /app/
COPY tests/ /app/tests/
COPY sql/init.sql /app/sql/init.sql

RUN apt-get update && \
    apt-get install -y sqlite3 && \
    rm -rf /var/lib/apt/lists/* && \
    sqlite3 database.db < /app/sql/init.sql

CMD ["php", "tests/tests.php"]

