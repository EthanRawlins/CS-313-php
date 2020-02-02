CREATE DATABASE shoeStore;

\c shoeStore

CREATE TABLE public.admin
(
   admin_id SERIAL NOT NULL PRIMARY KEY,
   username VARCHAR(100) NOT NULL UNIQUE,
   password VARCHAR(100) NOT NULL,
   admin_fname VARCHAR(100) NOT NULL,
   admin_lname VARCHAR(100) NOT NULL,
   added_by INT(10)
);

CREATE TABLE public.item
(
   item_id SERIAL NOT NULL PRIMARY KEY,
   item_type INT NOT NULL,
   item_price INT NOT NULL,
   item_brand VARCHAR(100) NOT NULL,
   item_name VARCHAR(100) NOT NULL,
   added_by INT NOT NULL REFERENCES public.admin(added_by)
);
