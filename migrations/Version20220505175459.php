<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505175459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, societe_id INT DEFAULT NULL, societe_historique_id INT DEFAULT NULL, numero VARCHAR(10) NOT NULL, type_voie VARCHAR(255) NOT NULL, nom_voie VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postale VARCHAR(5) NOT NULL, INDEX IDX_C35F0816FCF77503 (societe_id), INDEX IDX_C35F08167438847A (societe_historique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe (id INT AUTO_INCREMENT NOT NULL, form_juridique_id INT NOT NULL, nom VARCHAR(255) NOT NULL, siren VARCHAR(9) NOT NULL, ville_immatriculation VARCHAR(255) NOT NULL, capital VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_19653DBD70C59830 (form_juridique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe_historique (id INT AUTO_INCREMENT NOT NULL, form_juridique_id INT NOT NULL, societe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, siren VARCHAR(9) NOT NULL, ville_immatriculation VARCHAR(255) NOT NULL, date_immatriculation DATETIME NOT NULL, capital VARCHAR(255) NOT NULL, date_changement_immatriculation DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_F2E6F17370C59830 (form_juridique_id), INDEX IDX_F2E6F173FCF77503 (societe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08167438847A FOREIGN KEY (societe_historique_id) REFERENCES societe_historique (id)');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBD70C59830 FOREIGN KEY (form_juridique_id) REFERENCES forme_juridique (id)');
        $this->addSql('ALTER TABLE societe_historique ADD CONSTRAINT FK_F2E6F17370C59830 FOREIGN KEY (form_juridique_id) REFERENCES forme_juridique (id)');
        $this->addSql('ALTER TABLE societe_historique ADD CONSTRAINT FK_F2E6F173FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816FCF77503');
        $this->addSql('ALTER TABLE societe_historique DROP FOREIGN KEY FK_F2E6F173FCF77503');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08167438847A');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE societe');
        $this->addSql('DROP TABLE societe_historique');
    }
}
