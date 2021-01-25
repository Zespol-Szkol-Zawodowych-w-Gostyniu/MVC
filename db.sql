CREATE TABLE categories(
    id integer auto_increment,
    name varchar(100),
    primary key(id)
);
CREATE TABLE articles(
    id integer auto_increment,
    title varchar(100),
    content text,
    date_add datetime,
    autor varchar(100),
    id_categories integer,
    primary key(id),
    foreign key(id_categories) references categories(id)
);