# Use this file as a command
# 
# start
#	- starts the containers
#
# stop
#	- stops the containers
#
# run <command>
#	- runs <command> on the designated containers
#	options:
#		- new - builds new laravel project
#		- setup - sets up project
#		- migrate - migrates database
#
case $1 in
	# start
	start)
		failed=1
		docker-compose up -d --build app && echo docker app started && failed=0
		if [ $failed -eq 1 ]
		then
			echo "docker app failed to start"
		fi
		;;
	# stop
	stop)
		failed=1
		docker-compose down && echo docker app stopped && failed=0
		if [ $failed -eq 1 ]
		then
			echo "docker app failed to stop"
		fi
		;;
	# run
	run)
		case $2 in
			new)
				read -p "Confirm (y/N):" confirm
				if [ "$confirm" = 'y' ] || [ "$confirm" = 'Y' ]
				then
					rm -rf ./src/* && rm -f ./src/.* && docker-compose run --rm composer create-project laravel/laravel .
				else
					echo "Canceled project setup"
				fi
				;;
			# run setup
			setup)
				docker-compose run --rm composer install
				docker-compose run --rm npm run dev
				docker-compose run --rm artisan migrate:fresh --seed
				echo "docker app setup"
				;;
			# run migrate
			migrate)
				docker-compose run --rm artisan migrate:fresh --seed
				echo "docker app migrated"
				;;
			# run ____
			*)
				if [ -z $2 ]
				then
					echo "No arguments where provided after \"$1\"."
				else
					echo "unknown command"
				fi
				;;
		esac
		;;
	# ____
	*)
		if [ -z $1 ]
		then
			echo "No arguments where provided."
		else
			echo "unknown command"
		fi
		;;
esac

