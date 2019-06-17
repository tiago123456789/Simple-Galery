CREATE TABLE posts(
    id SERIAL PRIMARY KEY,
    likes INTEGER Default 0,
    unlikes INTEGER Default 0,
    describe varchar(255),
    path_image varchar(255)
);