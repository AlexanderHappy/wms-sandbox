<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250626131604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE inventories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE properties (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, type_id INT NOT NULL, INDEX IDX_87C331C7C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE property_list (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE property_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE property_value (id INT AUTO_INCREMENT NOT NULL, value_string VARCHAR(255) DEFAULT NULL, value_int INT DEFAULT NULL, value_decimal NUMERIC(24, 8) DEFAULT NULL, value_boolean TINYINT(1) DEFAULT NULL, property_list_id INT DEFAULT NULL, property_id INT NOT NULL, inventory_id INT NOT NULL, INDEX IDX_DB64993964635CF3 (property_list_id), INDEX IDX_DB649939549213EC (property_id), INDEX IDX_DB6499399EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE properties ADD CONSTRAINT FK_87C331C7C54C8C93 FOREIGN KEY (type_id) REFERENCES property_type (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property_value ADD CONSTRAINT FK_DB64993964635CF3 FOREIGN KEY (property_list_id) REFERENCES property_list (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property_value ADD CONSTRAINT FK_DB649939549213EC FOREIGN KEY (property_id) REFERENCES properties (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property_value ADD CONSTRAINT FK_DB6499399EEA759 FOREIGN KEY (inventory_id) REFERENCES inventories (id)
        SQL);

        // Necessary data for property_type table
        /*$this->addSql(
            <<<'SQL'
            INSERT INTO property_type (title, slug)
            VALUES
            ('Строка', 'String'),
            ('Целое число', 'Integer'),
            ('Число с плавающей точкой', 'Decimal'),
            ('Булево', 'Boolean')
        SQL
        );*/
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE properties DROP FOREIGN KEY FK_87C331C7C54C8C93
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property_value DROP FOREIGN KEY FK_DB64993964635CF3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property_value DROP FOREIGN KEY FK_DB649939549213EC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property_value DROP FOREIGN KEY FK_DB6499399EEA759
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE inventories
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE properties
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE property_list
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE property_type
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE property_value
        SQL);
    }
}
