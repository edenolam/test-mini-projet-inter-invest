<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506143919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse_historique (id INT AUTO_INCREMENT NOT NULL, societe_historique_id INT DEFAULT NULL, numero INT NOT NULL, type_voie VARCHAR(255) NOT NULL, nom_voie VARCHAR(255) NOT NULL, codepostal VARCHAR(5) NOT NULL, INDEX IDX_82A2A59B7438847A (societe_historique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse_historique ADD CONSTRAINT FK_82A2A59B7438847A FOREIGN KEY (societe_historique_id) REFERENCES societe_historique (id)');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08167438847A');
        $this->addSql('DROP INDEX IDX_C35F08167438847A ON adresse');
        $this->addSql('ALTER TABLE adresse DROP societe_historique_id');
        $this->addSql('ALTER TABLE societe DROP FOREIGN KEY FK_19653DBD70C59830');
        $this->addSql('DROP INDEX UNIQ_19653DBD70C59830 ON societe');
        $this->addSql('ALTER TABLE societe CHANGE form_juridique_id forme_juridique_id INT NOT NULL');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBD9AEE68EB FOREIGN KEY (forme_juridique_id) REFERENCES forme_juridique (id)');
        $this->addSql('CREATE INDEX IDX_19653DBD9AEE68EB ON societe (forme_juridique_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE adresse_historique');
        $this->addSql('ALTER TABLE adresse ADD societe_historique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08167438847A FOREIGN KEY (societe_historique_id) REFERENCES societe_historique (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C35F08167438847A ON adresse (societe_historique_id)');
        $this->addSql('ALTER TABLE societe DROP FOREIGN KEY FK_19653DBD9AEE68EB');
        $this->addSql('DROP INDEX IDX_19653DBD9AEE68EB ON societe');
        $this->addSql('ALTER TABLE societe CHANGE forme_juridique_id form_juridique_id INT NOT NULL');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBD70C59830 FOREIGN KEY (form_juridique_id) REFERENCES forme_juridique (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_19653DBD70C59830 ON societe (form_juridique_id)');
    }
}
