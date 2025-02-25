<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190812155335 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact CHANGE lastname lastname VARCHAR(255) DEFAULT NULL, CHANGE firstname firstname VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE event CHANGE author_id author_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE slug slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medium DROP INDEX IDX_C67345B7BA70CFC8, ADD UNIQUE INDEX UNIQ_C67345B7BA70CFC8 (private_post_id)');
        $this->addSql('ALTER TABLE medium DROP INDEX IDX_C67345B7B5A459A0, ADD UNIQUE INDEX UNIQ_C67345B7B5A459A0 (news_id)');
        $this->addSql('ALTER TABLE medium DROP INDEX IDX_C67345B771F7E88B, ADD UNIQUE INDEX UNIQ_C67345B771F7E88B (event_id)');
        $this->addSql('ALTER TABLE medium DROP FOREIGN KEY FK_C67345B771F7E88B');
        $this->addSql('ALTER TABLE medium DROP FOREIGN KEY FK_C67345B7B5A459A0');
        $this->addSql('ALTER TABLE medium DROP FOREIGN KEY FK_C67345B7BA70CFC8');
        $this->addSql('ALTER TABLE medium CHANGE event_id event_id INT DEFAULT NULL, CHANGE news_id news_id INT DEFAULT NULL, CHANGE private_post_id private_post_id INT DEFAULT NULL, CHANGE type type VARCHAR(255) DEFAULT NULL, CHANGE url url VARCHAR(255) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE medium ADD CONSTRAINT FK_C67345B771F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE medium ADD CONSTRAINT FK_C67345B7B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id)');
        $this->addSql('ALTER TABLE medium ADD CONSTRAINT FK_C67345B7BA70CFC8 FOREIGN KEY (private_post_id) REFERENCES private_post (id)');
        $this->addSql('ALTER TABLE news CHANGE author_id author_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE slug slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_post CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE role CHANGE role role VARCHAR(20) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57698A6A57698A6A ON role (role)');
        $this->addSql('ALTER TABLE tag CHANGE title title VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE address_city address_city VARCHAR(255) DEFAULT NULL, CHANGE address_street address_street VARCHAR(255) DEFAULT NULL, CHANGE address_other address_other VARCHAR(255) DEFAULT NULL, CHANGE address_number address_number INT DEFAULT NULL, CHANGE address_zipcode address_zipcode VARCHAR(15) DEFAULT NULL, CHANGE newsletter_subscription newsletter_subscription TINYINT(1) DEFAULT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json_array)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact CHANGE lastname lastname VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE firstname firstname VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE event CHANGE author_id author_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\', CHANGE slug slug VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE medium DROP INDEX UNIQ_C67345B7B5A459A0, ADD INDEX IDX_C67345B7B5A459A0 (news_id)');
        $this->addSql('ALTER TABLE medium DROP INDEX UNIQ_C67345B7BA70CFC8, ADD INDEX IDX_C67345B7BA70CFC8 (private_post_id)');
        $this->addSql('ALTER TABLE medium DROP INDEX UNIQ_C67345B771F7E88B, ADD INDEX IDX_C67345B771F7E88B (event_id)');
        $this->addSql('ALTER TABLE medium DROP FOREIGN KEY FK_C67345B7B5A459A0');
        $this->addSql('ALTER TABLE medium DROP FOREIGN KEY FK_C67345B7BA70CFC8');
        $this->addSql('ALTER TABLE medium DROP FOREIGN KEY FK_C67345B771F7E88B');
        $this->addSql('ALTER TABLE medium CHANGE news_id news_id INT DEFAULT NULL, CHANGE private_post_id private_post_id INT DEFAULT NULL, CHANGE event_id event_id INT DEFAULT NULL, CHANGE type type VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE url url VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE medium ADD CONSTRAINT FK_C67345B7B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('ALTER TABLE medium ADD CONSTRAINT FK_C67345B7BA70CFC8 FOREIGN KEY (private_post_id) REFERENCES private_post (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('ALTER TABLE medium ADD CONSTRAINT FK_C67345B771F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950F675F31B');
        $this->addSql('ALTER TABLE news CHANGE author_id author_id INT NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\', CHANGE slug slug VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE private_post CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('DROP INDEX UNIQ_57698A6A57698A6A ON role');
        $this->addSql('ALTER TABLE role CHANGE role role VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE tag CHANGE title title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user CHANGE address_city address_city VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address_street address_street VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address_other address_other VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address_number address_number INT DEFAULT NULL, CHANGE address_zipcode address_zipcode VARCHAR(15) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE newsletter_subscription newsletter_subscription TINYINT(1) DEFAULT \'NULL\', CHANGE is_active is_active TINYINT(1) DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\', CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
