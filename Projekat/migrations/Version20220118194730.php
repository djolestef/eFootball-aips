<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118194730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_data (id INT NOT NULL PRIMARY KEY, name VARCHAR(256) NOT NULL, city VARCHAR(128) NOT NULL, address VARCHAR(256) NOT NULL, phone_number VARCHAR(128), second_phone_number VARCHAR(128), FOREIGN KEY(id) REFERENCES fos_user(id))');
        $this->addSql('CREATE TABLE client_data (id INT NOT NULL PRIMARY KEY, first_name VARCHAR(128) NOT NULL, last_name VARCHAR(128) NOT NULL, city VARCHAR(128) NOT NULL,phone_number VARCHAR(64), FOREIGN KEY(id) REFERENCES fos_user(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE company_data');
        $this->addSql('DROP TABLE client_data');
    }
}
