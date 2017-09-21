#!/bin/sh

#Procurando o arquivo

inotifywait -m /var/www/html/cavidade_3_paredes/fig -e create -e  moved_to |
	while read path action file; do
		wolfram -script /var/www/html/cavidade_3_paredes/fig/cavidade3paredes
	done

