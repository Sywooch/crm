<?php

use yii\db\Migration;
use yii\base\InvalidConfigException;
use yii\rbac\DbManager;

class m170528_194112_init extends Migration
{
    private $userTable = '{{%user}}';
    private $projectTable = '{{%project}}';
    private $projectStatusTable = '{{%project_status}}';
    private $contractorTable = '{{%contractor}}';
    private $lnkProjectContractorTable = '{{%lnk_project_contractor}}';
    private $opfTable = '{{%opf}}';
    private $contactTable = '{{%contact}}';
    private $authorityBasisTable = '{{%authority_basis}}';
    private $relationshipTable = '{{%relationship}}';
    private $documentTable = '{{%document}}';
    private $documentTypeTable = '{{%document_type}}';
    private $folderTable = '{{%folder}}';

    /**
     * @throws yii\base\InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }
        return $authManager;
    }

    /**
     * @return bool
     */
    protected function isMSSQL()
    {
        return $this->db->driverName === 'mssql' || $this->db->driverName === 'sqlsrv' || $this->db->driverName === 'dblib';
    }

    /**
     * @inheritdoc
     */
    public function up()
    {
        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // RBAC
        $this->createTable($authManager->ruleTable, [
            'name' => $this->string(64)->notNull(),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (name)',
                ], $tableOptions);

        $this->createTable($authManager->itemTable, [
            'name' => $this->string(64)->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (name)',
            'FOREIGN KEY (rule_name) REFERENCES ' . $authManager->ruleTable . ' (name)' .
            ($this->isMSSQL() ? '' : ' ON DELETE SET NULL ON UPDATE CASCADE'),
                ], $tableOptions);
        $this->createIndex('idx-auth_item-type', $authManager->itemTable, 'type');

        $this->createTable($authManager->itemChildTable, [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY (parent, child)',
            'FOREIGN KEY (parent) REFERENCES ' . $authManager->itemTable . ' (name)' .
            ($this->isMSSQL() ? '' : ' ON DELETE CASCADE ON UPDATE CASCADE'),
            'FOREIGN KEY (child) REFERENCES ' . $authManager->itemTable . ' (name)' .
            ($this->isMSSQL() ? '' : ' ON DELETE CASCADE ON UPDATE CASCADE'),
                ], $tableOptions);

        $this->createTable($authManager->assignmentTable, [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'PRIMARY KEY (item_name, user_id)',
            'FOREIGN KEY (item_name) REFERENCES ' . $authManager->itemTable . ' (name) ON DELETE CASCADE ON UPDATE CASCADE',
                ], $tableOptions);

        // создание таблицы ПОЛЬЗОВАТЕЛИ
        $this->createTable($this->userTable, [
            'user_id' => $this->primaryKey()->comment('ID'),
            'lastname' => $this->string()->notNull()->comment('Фамилия'),
            'firstname' => $this->string()->notNull()->comment('Имя'),
            'patronymic' => $this->string()->notNull()->comment('Отчество'),
            'email' => $this->string()->notNull()->unique()->comment('E-mail'),
            'post' => $this->string()->notNull()->comment('Должность'),
            'mobilephone' => $this->string(11)->null()->comment('Мобильный телефон'),
            'password_hash' => $this->string()->notNull()->comment('Пароль хэш'),
            'password_reset_token' => $this->string()->null()->unique()->comment('Токен восстановления пароля'),
            'auth_key' => $this->string()->notNull()->comment('Ключ аутентификации'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Пользователи'");

        // создание таблицы ПРОЕКТЫ
        $this->createTable($this->projectTable, [
            'project_id' => $this->primaryKey()->comment('ID'),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'description' => $this->string()->null()->comment('Описание'),
            'site' => $this->string()->notNull()->comment('Сайт'),
            'site_test' => $this->string()->null()->comment('Тестовый сайт'),
            'user_id' => $this->integer()->null()->comment('Пользователь'),
            'project_status_id' => $this->integer()->notNull()->comment('Статус проекта'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Проекты'");
        $this->createIndex('idx-project-project_status_id', $this->projectTable, 'project_status_id');
        $this->createIndex('idx-project-user_id', $this->projectTable, 'user_id');

        // Создание таблицы СТАТУСЫ ПРОЕКТОВ
        $this->createTable($this->projectStatusTable, [
            'project_status_id' => $this->primaryKey()->comment('ID'),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Статусы проектов'");

        // Создание таблицы КОНТРАГЕНТЫ
        $this->createTable($this->contractorTable, [
            'contractor_id' => $this->primaryKey()->comment('ID'),
            'opf_id' => $this->integer()->null()->comment('Организационно-правовая форма'),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'description' => $this->string()->null()->comment('Описание'),
            'email' => $this->string()->notNull()->comment('E-mail'),
            'phone' => $this->string(20)->notNull()->comment('Телефон'),
            'fax' => $this->string(20)->null()->comment('Факс'),
            'legal_country' => $this->string()->null()->comment('Страна (юр. адрес)'),
            'legal_region' => $this->string()->null()->comment('Регион (юр. адрес)'),
            'legal_city' => $this->string()->null()->comment('Город (юр. адрес)'),
            'legal_street' => $this->string()->null()->comment('Улица (юр. адрес)'),
            'legal_house' => $this->string()->null()->comment('Дом (юр. адрес)'),
            'legal_postcode' => $this->integer(6)->null()->comment('Индекс (юр. адрес)'),
            'mailing_country' => $this->string()->null()->comment('Страна (почтовый адрес)'),
            'mailing_region' => $this->string()->null()->comment('Регион (почтовый адрес)'),
            'mailing_city' => $this->string()->null()->comment('Город (почтовый адрес)'),
            'mailing_street' => $this->string()->null()->comment('Улица (почтовый адрес)'),
            'mailing_house' => $this->string()->null()->comment('Дом (почтовый адрес)'),
            'mailing_postcode' => $this->integer(6)->null()->comment('Индекс (почтовый адрес)'),
            'bank' => $this->string()->null()->comment('Банк'),
            'bik' => $this->string(100)->null()->comment('БИК'),
            'rs' => $this->string(100)->null()->comment('Р/С'),
            'ks' => $this->string(100)->null()->comment('K/C'),
            'ogrn' => $this->string(100)->null()->comment('ОГРН'),
            'kpp' => $this->string(100)->null()->comment('КПП'),
            'inn' => $this->string(100)->null()->comment('ИНН'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Контрагенты'");
        $this->createIndex('idx-contractor-opf_id', $this->contractorTable, 'opf_id');

        // Создание таблицы ПРОЕКТЫ-КОНТРАГЕНТЫ
        $this->createTable($this->lnkProjectContractorTable, [
            'project_id' => $this->integer()->notNull()->comment('Проект'),
            'contractor_id' => $this->integer()->notNull()->comment('Контрагент'),
                ], $tableOptions . "  COMMENT='Проекты-Контрагенты'");
        $this->addPrimaryKey('pk-lnk_project_contractor-project_id-contractor_id', $this->lnkProjectContractorTable, ['project_id', 'contractor_id']);

        // Создание таблицы ОРГАНИЗАЦИОННО-ПРАВОВЫЕ ФОРМЫ
        $this->createTable($this->opfTable, [
            'opf_id' => $this->primaryKey()->comment('ID'),
            'short' => $this->string()->notNull()->comment('Сокращение'),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Организационно-правовые формы'");

        // Создание таблицы ОСНОВАНИЕ ПОЛНОМОЧИЙ
        $this->createTable($this->authorityBasisTable, [
            'authority_basis_id' => $this->primaryKey()->comment('ID'),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'genitive' => $this->string()->notNull()->comment('Родительный падеж'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Основания полномочий'");

        // Создание таблицы КОНТАКТЫ
        $this->createTable($this->contactTable, [
            'contact_id' => $this->primaryKey()->comment('ID'),
            'contractor_id' => $this->integer()->notNull()->comment('Контрагент'),
            'lastname' => $this->string()->notNull()->comment('Фамилия'),
            'firstname' => $this->string()->notNull()->comment('Имя'),
            'patronymic' => $this->string()->notNull()->comment('Отчество'),
            'authority_basis_id' => $this->integer()->null()->comment('Основание полномочий'),
            'email' => $this->string()->notNull()->unique()->comment('E-mail'),
            'post' => $this->string()->notNull()->comment('Должность'),
            'phone' => $this->string(11)->notNull()->comment('Телефон'),
            'description' => $this->string()->null()->comment('Описание'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Контакты'");
        $this->createIndex('idx-contact-contractor_id', $this->contactTable, 'contractor_id');
        $this->createIndex('idx-contact-authority_basis_id', $this->contactTable, 'authority_basis_id');

        // Создание таблицы ВЗАИМООТНОШЕНИЯ
        $this->createTable($this->relationshipTable, [
            'relationship_id' => $this->primaryKey()->comment('ID'),
            'contractor_id' => $this->integer()->null()->comment('Контрагент'),
            'contact_id' => $this->integer()->null()->comment('Контакт'),
            'user_id' => $this->integer()->null()->comment('Пользователь'),
            'title' => $this->string()->notNull()->comment('Заголовок'),
            'description' => $this->string()->notNull()->comment('Описание'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Взаимоотношения'");
        $this->createIndex('idx-relationship-contractor_id', $this->relationshipTable, 'contractor_id');
        $this->createIndex('idx-relationship-contact_id', $this->relationshipTable, 'contact_id');
        $this->createIndex('idx-relationship-user_id', $this->relationshipTable, 'user_id');

        // Создание таблицы ТИПЫ ДОКУМЕНТОВ
        $this->createTable($this->documentTypeTable, [
            'document_type_id' => $this->primaryKey()->comment('ID'),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Типы документов'");

        // Создание таблицы ПАПКИ
        $this->createTable($this->folderTable, [
            'folder_id' => $this->primaryKey()->comment('ID'),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Папки'");

        // Создание таблицы ДОКУМЕНТЫ
        $this->createTable($this->documentTable, [
            'document_id' => $this->primaryKey()->comment('ID'),
            'project_id' => $this->integer()->null()->comment('Проект'),
            'contractor_id' => $this->integer()->null()->comment('Контрагент'),
            'contact_id' => $this->integer()->null()->comment('Контакт'),
            'document_type_id' => $this->integer()->notNull()->comment('Тип документа'),
            'folder_id' => $this->integer()->null()->comment('Папка'),
            'name' => $this->string()->notNull()->comment('Имя документа'),
            'description' => $this->string()->null()->comment('Описание'),
            'filename' => $this->string()->notNull()->comment('Имя файла'),
            'created_at' => $this->integer()->null()->comment('Создан'),
            'updated_at' => $this->integer()->null()->comment('Обновлен')
                ], $tableOptions . "  COMMENT='Документы'");
        $this->createIndex('idx-document-project_id', $this->documentTable, 'project_id');
        $this->createIndex('idx-document-contractor_id', $this->documentTable, 'contractor_id');
        $this->createIndex('idx-document-contact_id', $this->documentTable, 'contact_id');
        $this->createIndex('idx-document-document_type_id', $this->documentTable, 'document_type_id');
        $this->createIndex('idx-document-folder_id', $this->documentTable, 'folder_id');

        // Создание внешних ключей
        $this->addForeignKey('fk-user-auth_assignment', $authManager->assignmentTable, 'user_id', $this->userTable, 'user_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-user-project', $this->projectTable, 'user_id', $this->userTable, 'user_id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk-project_status-project', $this->projectTable, 'project_status_id', $this->projectStatusTable, 'project_status_id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-project-lnk_project_contractor', $this->lnkProjectContractorTable, 'project_id', $this->projectTable, 'project_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-contractor-lnk_project_contractor', $this->lnkProjectContractorTable, 'contractor_id', $this->contractorTable, 'contractor_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-opf-contractor', $this->contractorTable, 'opf_id', $this->opfTable, 'opf_id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-contractor-contact', $this->contactTable, 'contractor_id', $this->contractorTable, 'contractor_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-authority_basis-contact', $this->contactTable, 'authority_basis_id', $this->authorityBasisTable, 'authority_basis_id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-contractor-relationship', $this->relationshipTable, 'contractor_id', $this->contractorTable, 'contractor_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-contact-relationship', $this->relationshipTable, 'contact_id', $this->contactTable, 'contact_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-user-relationship', $this->relationshipTable, 'user_id', $this->userTable, 'user_id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk-project-document', $this->documentTable, 'project_id', $this->projectTable, 'project_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-contractor-document', $this->documentTable, 'contractor_id', $this->contractorTable, 'contractor_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-contact-document', $this->documentTable, 'contact_id', $this->contactTable, 'contact_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-document_type-document', $this->documentTable, 'document_type_id', $this->documentTypeTable, 'document_type_id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-folder-document', $this->documentTable, 'folder_id', $this->folderTable, 'folder_id', 'RESTRICT', 'CASCADE');

        // Создание учетной записи
        $this->insert($this->userTable, [
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'admin@itisinfo.ru',
            'post' => 'Администратор системы',
            'password_hash' => '$2y$13$.sF4F.GNYZKYokAJ0HUrou2rxYKvUeWSlbvf2zytrKr4P8DRN423q', // 123456789
            'auth_key' => 'HyUx5Fdmbj4JTdwReKun_Ly1lD8KZ92S',
            'created_at' => time(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;

        $this->delete($this->userTable, ['user_id' => 1]);

        $this->dropForeignKey('fk-folder-document', $this->documentTable);
        $this->dropForeignKey('fk-document_type-document', $this->documentTable);
        $this->dropForeignKey('fk-contact-document', $this->documentTable);
        $this->dropForeignKey('fk-contractor-document', $this->documentTable);
        $this->dropForeignKey('fk-project-document', $this->documentTable);
        $this->dropForeignKey('fk-user-relationship', $this->relationshipTable);
        $this->dropForeignKey('fk-contact-relationship', $this->relationshipTable);
        $this->dropForeignKey('fk-authority_basis-contact', $this->contactTable);
        $this->dropForeignKey('fk-contractor-relationship', $this->relationshipTable);
        $this->dropForeignKey('fk-contractor-contact', $this->contactTable);
        $this->dropForeignKey('fk-opf-contractor', $this->contractorTable);
        $this->dropForeignKey('fk-contractor-lnk_project_contractor', $this->lnkProjectContractorTable);
        $this->dropForeignKey('fk-project-lnk_project_contractor', $this->lnkProjectContractorTable);
        $this->dropForeignKey('fk-project_status-project', $this->projectTable);
        $this->dropForeignKey('fk-user-project', $this->projectTable);
        $this->dropForeignKey('fk-user-auth_assignment', $authManager->assignmentTable);

        $this->dropTable($this->documentTable);
        $this->dropTable($this->folderTable);
        $this->dropTable($this->documentTypeTable);
        $this->dropTable($this->relationshipTable);
        $this->dropTable($this->contactTable);
        $this->dropTable($this->authorityBasisTable);
        $this->dropTable($this->opfTable);
        $this->dropTable($this->lnkProjectContractorTable);
        $this->dropTable($this->contractorTable);
        $this->dropTable($this->projectStatusTable);
        $this->dropTable($this->projectTable);
        $this->dropTable($this->userTable);
        $this->dropTable($authManager->assignmentTable);
        $this->dropTable($authManager->itemChildTable);
        $this->dropTable($authManager->itemTable);
        $this->dropTable($authManager->ruleTable);
    }

}
