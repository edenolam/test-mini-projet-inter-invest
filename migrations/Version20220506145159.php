<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506145159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe_historique DROP INDEX UNIQ_F2E6F17370C59830, ADD INDEX IDX_F2E6F17370C59830 (form_juridique_id)');
        $this->addSql('ALTER TABLE societe_historique ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP date_immatriculation, DROP date_changement_immatriculation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe_historique DROP INDEX IDX_F2E6F17370C59830, ADD UNIQUE INDEX UNIQ_F2E6F17370C59830 (form_juridique_id)');
        $this->addSql('ALTER TABLE societe_historique ADD date_immatriculation DATETIME NOT NULL, ADD date_changement_immatriculation DATETIME DEFAULT NULL, DROP created_at');
    }
}
