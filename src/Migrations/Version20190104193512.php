<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190104193512 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commentary (id INT AUTO_INCREMENT NOT NULL, fk_movie_id INT DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, created_datetime DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', score SMALLINT NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_1CAC12CABDBBF522 (fk_movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, release_date DATE DEFAULT NULL, length TIME DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, trailer VARCHAR(255) DEFAULT NULL, synopsis LONGTEXT DEFAULT NULL, budget INT DEFAULT NULL, box_office INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_worker (id INT AUTO_INCREMENT NOT NULL, fk_movie_id INT NOT NULL, fk_person_id INT NOT NULL, fk_job_id INT NOT NULL, INDEX IDX_66752217BDBBF522 (fk_movie_id), INDEX IDX_6675221740226CD7 (fk_person_id), INDEX IDX_667522172B4E2639 (fk_job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, born DATE NOT NULL, biography LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CABDBBF522 FOREIGN KEY (fk_movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE movie_worker ADD CONSTRAINT FK_66752217BDBBF522 FOREIGN KEY (fk_movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE movie_worker ADD CONSTRAINT FK_6675221740226CD7 FOREIGN KEY (fk_person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE movie_worker ADD CONSTRAINT FK_667522172B4E2639 FOREIGN KEY (fk_job_id) REFERENCES job (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE movie_worker DROP FOREIGN KEY FK_667522172B4E2639');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CABDBBF522');
        $this->addSql('ALTER TABLE movie_worker DROP FOREIGN KEY FK_66752217BDBBF522');
        $this->addSql('ALTER TABLE movie_worker DROP FOREIGN KEY FK_6675221740226CD7');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_worker');
        $this->addSql('DROP TABLE person');
    }
}
