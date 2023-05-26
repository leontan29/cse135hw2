drop table if exists activity;
create table activity(
       id int NOT NULL AUTO_INCREMENT,
       tracker varchar(50),
       page varchar(500),
       error varchar(1000),
       keydown varchar(10),
       mouse_x int,
       mouse_y int,
       click_x int,
       click_y int,
       scroll_y int,
       idle_time int,
       idle_time_ended_at bigint,
       enter_page_at bigint,
       leave_page_at bigint,
       primary key (id)
);

drop table if exists visit;
create table visit(
       id int NOT NULL AUTO_INCREMENT,
       tracker varchar(50),
       page varchar(500),
       user_agent varchar(200),
       language varchar(10),
       cookie_enabled int,
       screen_height int,
       screen_width int,
       window_height int,
       window_width int,
       network_type varchar(10),
       primary key (id)
);


drop table if exists perf;
create table perf(
       id int NOT NULL AUTO_INCREMENT,
       tracker varchar(50),
       page varchar(500),
       timing json,
       page_load_begin int,
       page_load_end int,
       page_load_time int,
       primary key (id)
);


       
