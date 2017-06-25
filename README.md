# ASW 2017
### Project: Online Poker Game

This project was made as part of the Web Applications and Services (ASW) course in Information Technology degree at the Faculty of Science, University of Lisbon.

The project consisted in developing a web app for users to play Texas hold 'em poker. To do so the authors used a LAMP approach with an MVC pattern applied using the CodeIgniter Framework. The app supports user registration, game management and admin functionalities. 

User functionalities:
* profile page, for updating personal info, password change, account charging, and avatar upload
* dashboard for managing games and joining new ones
* game page. 

Admin functionalities:
* user management
* game management

## Demo
### Main app:
[https://college.hugocurado.info/PokerOnline](https://college.hugocurado.info/PokerOnline)

User: my_name

Pass: my_password

### Admin:
[https://college.hugocurado.info/PokerOnline/admin](https://college.hugocurado.info/PokerOnline/admin)

User: admin001

Pass: Admin07

### Web Service:
* InfoPartida: Given the id of a game (e.g.: id=60) it returns a json with the game info
```
https://college.hugocurado.info/PokerOnline/SOAP/IpajSoapClient/InfoPartida?id=60
```

* ApostaJogo: With this web service a client can play the game. For it to work it needs the following parameters: id (the game id), username (the user’s username), password (the user’s password), play (the user’s play, check / fold / raise), value (only used on a raise play)
```
https://college.hugocurado.info/PokerOnline/SOAP/IpajSoapClient/ApostaJogo?id=61&username=robot001&password=Rob07&play=check
```


## Authors
* Ana Catarina Sousa (1)
* Hugo Curado (1)
* Pedro Neto (1)

(1) Informatics Department, Faculty of Science, University of Lisbon, Lisbon, Portugal

## License
2017 © Faculdade de Ciências da Universidade de Lisboa

