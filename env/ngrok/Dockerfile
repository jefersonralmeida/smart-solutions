FROM ubuntu:18.04

RUN apt-get update && \
    apt-get install -y wget unzip

RUN wget -O ngrok.zip https://bin.equinox.io/c/4VmDzA7iaHb/ngrok-stable-linux-amd64.zip && \
    unzip ngrok.zip && \
    rm ngrok.zip

COPY ./entrypoint.sh /entrypoint.sh

CMD ["/entrypoint.sh"]