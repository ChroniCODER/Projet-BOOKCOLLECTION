CREATE TABLE `book` (
  	   `id` INT NOT NULL AUTO_INCREMENT,
  	   `name` VARCHAR(150) NOT NULL,
  	   `release` DATE NOT NULL,
  	   `author_id` INT NOT NULL,
  	   `style_id` INT NOT NULL,
  	   PRIMARY KEY (`id`)
	  );

CREATE TABLE `user` (
  	   `id` INT NOT NULL AUTO_INCREMENT,
  	   `pseudo` VARCHAR(50) NOT NULL,
  	   `firstname` VARCHAR(80) NOT NULL,
  	   `lastname` VARCHAR(80) NOT NULL,
  	   `email` VARCHAR(80) NOT NULL,
  	   PRIMARY KEY (`id`)
	  );

CREATE TABLE `author` (
  	   `id` INT NOT NULL AUTO_INCREMENT,
  	   `firstname` VARCHAR(80) NOT NULL,
  	   `lastname` VARCHAR(80) NOT NULL,
  	   PRIMARY KEY (`id`)
	  );

CREATE TABLE `style` (
  	   `id` INT NOT NULL AUTO_INCREMENT,
  	   `name` VARCHAR(100) NOT NULL,
  		PRIMARY KEY (`id`)
	  );

CREATE TABLE `user_fav` (
		`id` INT NOT NULL AUTO_INCREMENT,
		`user_id` INT,
		`book_id` INT,
		 PRIMARY KEY (`id`)
	  );

ALTER TABLE book
	ADD CONSTRAINT fk_book_author
	FOREIGN KEY (author_id)
	REFERENCES author(id);

ALTER TABLE book
	ADD CONSTRAINT fk_book_style
	FOREIGN KEY (style_id)
	REFERENCES style(id);

ALTER TABLE user_fav
	ADD CONSTRAINT fk_user_fav_user
	FOREIGN KEY (user_id)
	REFERENCES user(id);

ALTER TABLE user_fav
	ADD CONSTRAINT fk_user_fav_book
	FOREIGN KEY (book_id)
	REFERENCES book(id);


