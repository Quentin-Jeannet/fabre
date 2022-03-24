<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323103850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL, ADD is_attending_meeting TINYINT(1) DEFAULT NULL, ADD is_remotely TINYINT(1) DEFAULT NULL, ADD is_need_train TINYINT(1) DEFAULT NULL, ADD is_need_flight TINYINT(1) DEFAULT NULL, ADD is_need_hotel TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP is_verified, DROP is_attending_meeting, DROP is_remotely, DROP is_need_train, DROP is_need_flight, DROP is_need_hotel');
    }
}
