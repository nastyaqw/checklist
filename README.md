### **Задание:** ###
1.	Админка:
<pre>•	Управление админами с разграничением прав;
•	Управление пользователями с возможностью блокировки;
• 	Управление кол-вом возможных чек-листов у пользователя (в зависимости от роли админа, необходимо ограничивать данный функционал);
•	Просмотр чек-листов.</pre>
2.	RestAPI (перечень методов которые необходимо реализовать):
<pre>•	Регистрация / Авторизация;
•	Создать/Удалить чек лист (учитывать настройки возможного кол-ва);
•	Добавить/Удалить пункт в чек лист;
•	Отметить выполнен/не выполнен пункт;
•	Получить список чек листов;
•	Получить список пунктов чек-листа с указанием выполнен/не выполнен.</pre>
 

### **Описание проекта** ###
#### <br>Web: ####
<br>Управление админами с разграничением прав:
* http://127.0.0.1:8000/users
* http://127.0.0.1:8000/users/{id}/edit
* http://127.0.0.1:8000/users/{id}
* http://127.0.0.1:8000/users/create
<br>Управление пользователями с возможностью блокировки (Active - 0 Заблокирован) и управление кол-вом возможных чек-листов у пользователя (max check):
* http://127.0.0.1:8000/users/{id}/edit
![editusersuper](https://github.com/nastyaqw/checklist/assets/79269539/2f532e37-702f-4585-9b91-e563a5cb66c9)
![blockchecked](https://github.com/nastyaqw/checklist/assets/79269539/7acaf487-52bd-404f-9f12-42b490c08eca)
![проверканалимит](https://github.com/nastyaqw/checklist/assets/79269539/7876992a-caaa-4766-a0fe-a907d448de14)
<br>Просмотр чек-листов:
* http://127.0.0.1:8000/checklists
* http://127.0.0.1:8000/checklists/{id}
* http://127.0.0.1:8000/checklists/{id}/edit
* http://127.0.0.1:8000/checklists/create
![Checklistsuper](https://github.com/nastyaqw/checklist/assets/79269539/a52b63d2-d44c-4401-902a-10f51ea7ac0f)
![ОбновлениечеклистаИван](https://github.com/nastyaqw/checklist/assets/79269539/a9d1f65c-3a99-4f48-9311-4da00c2c5465)
#### <br>RestAPI: ####
<br>Регистрация / Авторизация (POST):
* http://localhost:8000/api/login
![ap_login](https://github.com/nastyaqw/checklist/assets/79269539/8eb5a1fe-c416-4644-9a2d-1e9458f41df8)
* http://localhost:8000/api/register
![api_register](https://github.com/nastyaqw/checklist/assets/79269539/fe0c47e6-e464-42ca-9908-87c9fab06342)
<br>Создать/Удалить чек лист (учитывать настройки возможного кол-ва)(POST):
* http://localhost:8000/api/checklists/
![addcheck](https://github.com/nastyaqw/checklist/assets/79269539/325b0e2d-d857-4ad3-8437-df7b8e0a82ff)
<br>Добавить/Удалить пункт в чек лист;
<br>Отметить выполнен/не выполнен пункт (PUT);
* http://localhost:8000/api/checklists/{id}?is_done=0
![is_done](https://github.com/nastyaqw/checklist/assets/79269539/23330060-da47-47ae-963f-69165f246206)
<br>Получить список чек листов и с указанием выполнен/не выполнен(GET);
* http://localhost:8000/api/checklists/
![просмотр2](https://github.com/nastyaqw/checklist/assets/79269539/adaebabe-119c-46bc-b734-89dfa6b92d50)
<br>Super Admin, может выполнять все возможные функции:
* Создавать, удалять и редактировать роли. 
* Редактировать данные у всех пользователей, смотреть и удалять. 
* Просмотр чек-листов только своих. 
* Блокировать пользоваталей.
<br>Admin, может выполнять все возможные функции кроме создавать, удалять и редактировать роли.
Пользователь (Super Admin,Admin) может менять, то есть ограничвать количество чек-листов у себя и у других пользователей в зависимости какое количество у самого пользователя, под которым пользователь зашел.
<br>Checklist manager – может создавать чек-листы для себя, редактировать и удалять их.

### **Установка** ###
- ```git clone https://github.com/nastyaqw/checklist```
- ```cd checklist```
- ```cp .env.example .env```
- создать бд в  phpMyadmin записать название бд в .env (DB_DATABASE)
- ```composer install```
- ```composer update```
- ```php artisan key:generate```
- ```php artisan migrate --seed```, для создание и заполнения таблицы
- ```npm install```
- ```npm run build```
- ```php artisan serve```

### **Информация о доступах** ### 
<br>Super Admin 
            <pre>email => nastya@admin.com
            password => admin1</pre>
<br>Admin User
             <pre>email => ivan@admin.com
            password => admin2</pre>
<br>Checklist User
            <pre>email => elena@user.com
            password => user1</pre>
