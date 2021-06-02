*Gestion de stock*

Application web développé en PHP avec Symfony et l'ORM Doctrine
Permet la gestion d'un stock d'une salle editique (papiers, consommables, fournitures etc...) avec une gestion des utilisateurs et des droits d'accès

Base de données (MOCODO):

CONSUMABLE: _name,family,reference,quantity,createdAt,updatedAt,machine_id
USE, 0N CONSUMABLE, 01 MACHINE
MACHINE: _name

:
ENVELOPE: _name,reference,quantity,createdAt,updatedAt
HAS, 0N SUPPLY, 01 MACHINE

USER: _email, roles, password, firstname,lastname
PAPER: _name,reference,quantity,createdAt,updatedAt
SUPPLY: _name,reference,quantity,createdAt,updatedAt,machine_id
