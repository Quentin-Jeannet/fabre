<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323082406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE institution_name institution_name VARCHAR(255) DEFAULT NULL, CHANGE business_address business_address VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE zipcode zipcode INT DEFAULT NULL, CHANGE country country VARCHAR(255) DEFAULT NULL, CHANGE mobile_phone mobile_phone VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE institution_name institution_name VARCHAR(255) NOT NULL, CHANGE business_address business_address VARCHAR(255) NOT NULL, CHANGE city city VARCHAR(255) NOT NULL, CHANGE zipcode zipcode INT NOT NULL, CHANGE country country VARCHAR(255) NOT NULL, CHANGE mobile_phone mobile_phone VARCHAR(255) NOT NULL');
    }
}
