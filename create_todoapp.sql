drop database if exists todoapp;
create database todoapp;
use todoapp;

create table todos (
	id int not null auto_increment primary key,
	flag tinyint(1) default 0, /* 0が未完 */
	content text
);

insert into todos (flag, content) values (0, 'タスク１'), (0, 'タスク２'), (1, 'タスク３');
