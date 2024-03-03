
# CLI-Based Two-Player Vehicle Racing Game in PHP

Develop a CLI-based two-player racing game in PHP. The game begins with the players choosing a vehicle from a list provided in a vehicles.json file. Each vehicle has a maximum speed. The application will calculate the time taken by each vehicle to complete a given distance based on its speed, and then declare the winner.

## Table of Contents

-   [Project Setup](#project-setup)
-   [Tests](#tests)

## Project Setup

### I utilized [symfony/console ](https://github.com/symfony/console)  package for the Command-Line interface :

1.  php8.2 and composer must be pre-installed in your system.

2.  Clone the repo and navigate to the directory

    ```shell
    git clone https://github.com/ehsan9ir/php-race-game.git && cd php-racing-game
    ```

3.  Enter the following command in the terminal for install requirement packages

    ```shell
    composer install
    ```

4.  Enter the following command in the terminal for run project

    ```sh
    php index.php start:race
    ```

## Tests

To run the tests, use the following command:
`vendor/bin/phpunit tests`
[CalculateTimeBasedMaximumSpeedTest](tests/CalculateDuringTimeBasedMaximumSpeedTest.php) ,[RacingGameTest](tests/RacingGameTest.php).

