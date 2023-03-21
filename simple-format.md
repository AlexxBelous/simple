\***\*\*\*\*\***\*\*\***\*\*\*\*\***\*\***\*\*\*\*\***\*\*\***\*\*\*\*\***Comand Linux\***\*\*\*\*\***\*\*\*\*\***\*\*\*\*\***\*\*\*\***\*\*\*\*\***\*\*\*\*\***\*\*\*\*\***
touch имя*файла_1.txt имя*файла_2.txt

ls -a список всех файлов включая скрытые

cp -r file_name_of_the_directory_we_want_to_copy new_file_name_or_directory

cp file_name create_new_name_file (копируем и переименуем просто файл без флажка r)

mkdir create_directory_name next_create_directory

rm -rf name_folder/\* - удаляет все содержимое папки(как файлы так и папки)

rm -rf \* - удаляет все в текущей папке.

cal >> create_name_file.txt (writing calendar to file from terminal)

rm the_name_of_the_file_you_want_to_delete.txt the_next_name_of_the_file_you_want_to_delete.doc

find ~ -iname enter_find_name (иск файла)

gedit name_file (открыть файл в графическом интерфейсе)

pwd (получаем полный путь от корневого каталога к текущему)

cat > name_file (удаление старого содержания файла и ввод нового)

mv name_file_or_name_folder create_newname_for_file_or_folder (переименовать файл или папку)

du -h (получить размер текущей директории)

zip -r create_name_archive name_folder_or_file (создать архив zip)

ps (вывод списка работающих программ)

cat fiel_name (вывод содержимого файла на экран)

uptime (сколько времени работает система без перезагрузки и выключения)

alias command_assignment=command_terminal(ls, pwd) (присвоение команды терминалу

---

\***\*\*\*\*\***\*\*\***\*\*\*\*\***\*\*\***\*\*\*\*\***\*\*\***\*\*\*\*\***Права доступа**\*\***\*\*\*\***\*\***\*\***\*\***\*\*\*\***\*\***\***\*\***\*\*\*\***\*\***\*\***\*\***\*\*\*\***\*\***
chown – изменить владельца файла / директории
chgrp – изменить группу файла / директории
сhmod – изменить права доступа на файл / директорию

**\***Для файлов**\*\*\*\***\*\***\*\*\*\***
r - право на чтение содержимого.
w - право на запись, изменение.
x - право на исполнение, запуск.

**\*\***Для папок**\*\*\*\***\***\*\*\*\***
r - получать список файлов.
w - создавать и удалять файлы.
x - проход сквозь папку(не разрешает удалять, создавать и видеть содержимое).

sudo chmod ugo+x myfile.txt довавить X всем
sudo сhmod g-rw myfile.txt убрать RW у группы
sudo chmod o=rw myfile.txt установить RW всем остальным

u = user
g = group
o = other
a = ugo

chmod 777 myfile.txt установить RWX всем
chmod 741 myfile.txt установить: RWX владельцу, R - - группе, - - X всем остальным
r = 4
w = 2
x = 1

---

**\*\*\*\***\*\***\*\*\*\***\*\***\*\*\*\***\*\***\*\*\*\***apache2\***\*\*\*\*\*\*\***\*\*\***\*\*\*\*\*\*\***\*\***\*\*\*\*\*\*\***\*\*\***\*\*\*\*\*\*\***
Отключить внутренний сервер apache2 - sudo update-rc.d apache2 disable
Включить внутренний сервер apache2 - sudo update-rc.d apache2 enable

---

**\*\***\*\*\*\***\*\***\***\*\***\*\*\*\***\*\***wordpress \***\*\*\*\*\***\*\*\***\*\*\*\*\***\*\*\***\*\*\*\*\***\*\*\***\*\*\*\*\***
-скачать wordpress - sudo wget -c http://wordpress.org/latest.tar.gz
-распаковать архив - sudo tar -xzvf latest.tar.gz

- копируем все файлы wordpress, которые внутри -  
  sudo rsync -av wordpress/\* /opt/lampp/htdocs/genius/

  -создаем базу данных
  -создаем файл wp-confin.php
  -закидываем туда необходимое содержимое
  -добавляем для записи ошибок следующие строки:
  /**\*\*\*\***\*\***\*\*\*\***\***\*\*\*\***\*\***\*\*\*\***

define( 'FS_METHOD', 'direct' );

define( 'WP_DEBUG', true );

define( 'WP_DEBUG_LOG', true );

define( 'WP_DEBUG_DISPLAY', false );

define( 'SCRIPT_DEBUG', true ); \***\*\*\*\*\***\*\*\***\*\*\*\*\***\*\*\*\*\***\*\*\*\*\***\*\*\***\*\*\*\*\***\

sudo chown -R $USER:$USER name-site/
sudo chmod -R 777 name-site/

---

**\*\*\*\***\*\*\*\***\*\*\*\***\*\*\*\***\*\*\*\***\*\*\*\***\*\*\*\***add domain Linux**\*\***\*\*\*\***\*\***\***\*\***\*\*\*\***\*\***
1)cd /opt/lampp/etc/ 2) sudo nano +488 httpd.conf 3) удаляем # на строке Include etc/extra/httpd-vhosts.conf

4.  /opt/lampp/etc/extra sudo nano httpd-vhosts.conf дублируем блок <VirtualHost \*:80>
5.  удаляем строчки которые начинаются на слова: CustomLog, ErrorLog и ServerAdmin.
6.  в DocumentRoot указываем свой путь. например ""
7.  в ServerName указываем название имени сервер. ...
8.  создаем новый html block и добавляем внутрь строки.

Пример как все должно выглядеть:
<VirtualHost \*:80>
DocumentRoot "/opt/lampp/htdocs/phpcoursealex"
ServerName phpcoursealex.com
<Directory "/opt/lampp/htdocs/phpcoursealex">
AllowOverride All
Require all granted
</Directory>
</VirtualHost>

9. дальше в терминале reset
10. cd /etc/, затем sudo nano hosts и добавляем строчку 127.0.0.1 и новое имея localhost

sudo chown -R $USER:$USER name-site/
sudo chmod -R 777 name-site/

sport-island.loc

---

**\*\*\*\***\*\***\*\*\*\***\*\*\***\*\*\*\***\*\***\*\*\*\***Wordpress for dev\***\*\*\*\*\***\*\*\***\*\*\*\*\***\*\*\*\***\*\*\*\*\***\*\*\***\*\*\*\*\***\

1. В папке на сервере где будет проект, создаем файл composer.json в котором пришеи { }
2. Пишем команду - composer require wordpress.
3. Дальше пишем команду - composer require johnpbloch/wordpress
4. Добавляем в composer.json репозиторий, с которого будет устанавлевать плагины
   и указываем путь. Пример кода ниже:

"repositories": [
{
"type": "composer",
"url": "https://wpackagist.org"
}
],
"extra": {
"installer-paths": {
"wordpress/wp-content/plugins/{$name}/":["type:wordpress-plugin"],
            "wordpress/wp-content/theme/{$name}/":["type:wordpress-theme"]
}
}

5. Устанавливаем плагины:
   composer require wpackagist-plugin/advanced-custom-fields
   composer require wpackagist-plugin/contact-form-7
   composer require wpackagist-plugin/hc-custom-wp-admin-url
   composer require wpackagist-plugin/rus-to-lat-advanced

---

**\*\***\*\***\*\***\*\***\*\***\*\***\*\***GIT**\*\***\*\***\*\***\*\***\*\***\*\***\*\***\*\***\*\***\*\***\*\***\*\***\*\***\*\***\*\***

- git config --global user.name AlexxBelous
- git config --global user.email connectionwithme1@gmail.com
- git config --list
- Создать репозиторий в папке - git init
- Состояние репозитория - git status
- Добавить страницу в репозиторий - git add hello.html
- Добавить все изменения в репозиторий - git add .
- Сделать коммит - git commit -m "это комментарий к комиту"
- Редактировать сообщение в последнем коммите - git commit --amend
- Историю всех коммитов - git log
- История всех коммитов с декорациями git log --all --graph --decorate
- История 14 последних коммитов git log -p -14

- Прочитать информацию с коммита - git cat-file -t 1234567(первые 7 цифр хеша)
- Прочитать информацию с коммита - git cat-file -p 1234567(первые 7 цифр хеша)

- Получить информацию о коммите git show <весь хеш коммита или 7 значений >

- Убрать последние изменение с документа который не закомичен git restore <название документа>

- Просмотреть какие изменения были внесены в файл с момента последнего коммита git diff <название документа>

-Удаление закомеченого файла при этом файл которой в рабочей директории остается и получает статус не отслеживаемый git rm --cached <name file>

-Отменить последний коммит(но не отменит изменения в файле) - git reset --soft HEAD^

- Переключение в желаемую версию комита - git checkout <1234567>(7цифр хеша)
  Крайне не рекомендуется так делать. Для того чтобы вернуться в ветку master
  нужно ввести команду git checkout master
  -Если после переключения на ветку вносили изменения-экспериментировали, необходимо все вернуть в исходное положение - git restore

- Создание новой ветки git branch <branch name>
- Создание новой ветки и переход в эту же ветку git checkout -b <branch name>
- Перейти в желаемую ветку - git checkout <branch name>
- Изменения названия ТЕКУЩЕЙ ветки git branch -m <new branch name>

- Для удаление ветки git branch -d <branch name> (Текущую ветку удалить нельзя)

- Отобразить список существующих ветвей git branch

- Слияние ветки ТЕКУЩЕЙ(receiving branch) с другой(feature branch) веткой
- marge -m(сообщение для мерж коммита) <feature branch name>

- Проверка подключен ли к удаленному серверу - git remote

- Подключение к удаленному репозиторию(команды github)
- remote add origin git@github.com:AlexxBelous/project.git
- branch -M master - переименовать на рекомендуемое название master
- push -u origin master - загрузка в удаленный репозиторий.

- Получаем файлы с удаленного репозитория - git clone https://github.com/bstashchuk/docker.git

- Чтобы увидеть ссылку на удаленный репозиторий - git remote -v

- Для просмотра связи локальной ветки с удаленной веткой - git branch -vv

- Для записи данных в удаленные репозиторий. На сайте GitHub > settings > Developer settings > personal access tokens > Generate new token > note > expiration days > галочка repo > Generate token.

- для того чтобы сделать push - git push -u origin <branch name remote>
  нажимаем enter вводим имя, токен. Название локальной ветки и удаленной должны совпадать.

