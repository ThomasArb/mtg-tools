<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190610183328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE deck_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_deck_link_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE game_player_deck_link (game_id INT NOT NULL, player_deck_link_id INT NOT NULL, PRIMARY KEY(game_id, player_deck_link_id))');
        $this->addSql('CREATE INDEX IDX_94562FEAE48FD905 ON game_player_deck_link (game_id)');
        $this->addSql('CREATE INDEX IDX_94562FEAA917672F ON game_player_deck_link (player_deck_link_id)');
        $this->addSql('CREATE TABLE deck (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player_deck_link (id INT NOT NULL, deck_id INT NOT NULL, player_id INT NOT NULL, win BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AA47E8F6111948DC ON player_deck_link (deck_id)');
        $this->addSql('CREATE INDEX IDX_AA47E8F699E6F5DF ON player_deck_link (player_id)');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE game_player_deck_link ADD CONSTRAINT FK_94562FEAE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_player_deck_link ADD CONSTRAINT FK_94562FEAA917672F FOREIGN KEY (player_deck_link_id) REFERENCES player_deck_link (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_deck_link ADD CONSTRAINT FK_AA47E8F6111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_deck_link ADD CONSTRAINT FK_AA47E8F699E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game_player_deck_link DROP CONSTRAINT FK_94562FEAE48FD905');
        $this->addSql('ALTER TABLE player_deck_link DROP CONSTRAINT FK_AA47E8F6111948DC');
        $this->addSql('ALTER TABLE game_player_deck_link DROP CONSTRAINT FK_94562FEAA917672F');
        $this->addSql('ALTER TABLE player_deck_link DROP CONSTRAINT FK_AA47E8F699E6F5DF');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE deck_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_deck_link_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_player_deck_link');
        $this->addSql('DROP TABLE deck');
        $this->addSql('DROP TABLE player_deck_link');
        $this->addSql('DROP TABLE player');
    }
}
