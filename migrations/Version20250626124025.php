<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250626124025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
            CREATE TABLE inventories
            (
                id INT AUTO_INCREMENT NOT NULL,
                title VARCHAR(255) NOT NULL,
                PRIMARY KEY(id)
            )
                DEFAULT CHARACTER SET utf8mb4
        SQL
        );

        $this->addSql(
            <<<'SQL'
            CREATE TABLE properties (
                id INT AUTO_INCREMENT NOT NULL,
                title VARCHAR(255) NOT NULL,
                slug VARCHAR(255) NOT NULL,
                type_id_id INT NOT NULL,
                INDEX IDX_87C331C7714819A0 (type_id_id),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4
        SQL
        );
        $this->addSql(
        "CREATE TABLE property_list(
                id    INT AUTO_INCREMENT NOT NULL,
                title VARCHAR(255)       NOT NULL,
                slug  VARCHAR(255)       NOT NULL,
                value VARCHAR(255)       NOT NULL,
                PRIMARY KEY ( id )
            ) DEFAULT CHARACTER SET utf8mb4"
        );
        $this->addSql(
            <<<'SQL'
                CREATE TABLE property_type
                (
                    id    INT AUTO_INCREMENT NOT NULL,
                    title VARCHAR(255)       NOT NULL,
                    slug  VARCHAR(255)       NOT NULL,
                    PRIMARY KEY ( id )
                ) DEFAULT CHARACTER SET utf8mb4
            SQL
        );
        $this->addSql(
            <<<'SQL'
                CREATE TABLE property_value
                (
                    id                  INT AUTO_INCREMENT NOT NULL,
                    value_string        VARCHAR(255)   DEFAULT NULL,
                    value_int           INT            DEFAULT NULL,
                    value_decimal       NUMERIC(24, 8) DEFAULT NULL,
                    value_boolean       TINYINT(1)     DEFAULT NULL,
                    property_list_id_id INT            DEFAULT NULL,
                    property_id_id      INT                NOT NULL,
                    inventory_id_id     INT                NOT NULL,
                    INDEX IDX_DB64993913762A67 ( property_list_id_id ),
                    INDEX IDX_DB649939B9575F5A ( property_id_id ),
                    INDEX IDX_DB649939A3D83557 ( inventory_id_id ),
                    PRIMARY KEY ( id )
                ) DEFAULT CHARACTER SET utf8mb4
            SQL
        );
        $this->addSql(
            <<<'SQL'
            ALTER TABLE properties ADD CONSTRAINT FK_87C331C7714819A0 FOREIGN KEY (type_id_id) REFERENCES property_type (id)
        SQL
        );
        $this->addSql(
            <<<'SQL'
            ALTER TABLE property_value ADD CONSTRAINT FK_DB64993913762A67 FOREIGN KEY (property_list_id_id) REFERENCES property_list (id)
        SQL
        );
        $this->addSql(
            <<<'SQL'
            ALTER TABLE property_value ADD CONSTRAINT FK_DB649939B9575F5A FOREIGN KEY (property_id_id) REFERENCES properties (id)
        SQL
        );
        $this->addSql(
            <<<'SQL'
            ALTER TABLE property_value ADD CONSTRAINT FK_DB649939A3D83557 FOREIGN KEY (inventory_id_id) REFERENCES inventories (id)
        SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
            ALTER TABLE properties DROP FOREIGN KEY FK_87C331C7714819A0
        SQL
        );
        $this->addSql(
            <<<'SQL'
            ALTER TABLE property_value DROP FOREIGN KEY FK_DB64993913762A67
        SQL
        );
        $this->addSql(
            <<<'SQL'
            ALTER TABLE property_value DROP FOREIGN KEY FK_DB649939B9575F5A
        SQL
        );
        $this->addSql(
            <<<'SQL'
            ALTER TABLE property_value DROP FOREIGN KEY FK_DB649939A3D83557
        SQL
        );
        $this->addSql(
            <<<'SQL'
            DROP TABLE inventories
        SQL
        );
        $this->addSql(
            <<<'SQL'
            DROP TABLE properties
        SQL
        );
        $this->addSql(
            <<<'SQL'
            DROP TABLE property_list
        SQL
        );
        $this->addSql(
            <<<'SQL'
            DROP TABLE property_type
        SQL
        );
        $this->addSql(
            <<<'SQL'
            DROP TABLE property_value
        SQL
        );
    }
}
