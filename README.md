# Cardboard

### Table of Contents
- [Description](#description)
- [Installation](#installation)
- [Tests](#tests)
- [Credits](#credits)

#### <a id="description">Description</a>
An API for accessing Magic: The Gathering price data

#### <a id="installation">Installation</a>
1. Clone the repository: `gh repo clone DeathLotusLabs/cardboard`
2. Navigate to the project directory: `cd cardboard`
3. Install PHP dependencies: `composer install`
4. Install JavaScript dependencies: `npm install`
5. Compile assets: `npm run dev`
6. Generate an application key: `php artisan key:generate`
7. Run database migrations: `php artisan migrate`

#### <a id="tests">Tests</a>
Cardboard utilizes <a target="_blank" href="https://www.pestphp.com">Pest</a> for testing. Please include a test with each feature added.

```
php artisan test
```

## Contributing

First off, thank you for taking the time to contribute! 🎉

The following is a set of guidelines for contributing to Project Name. These are mostly guidelines, not rules. Use your best judgment, and feel free to propose changes to this document in a pull request.

### Table of Contents
- [How to Contribute](#how-to-contribute)
- [Code of Conduct](#code-of-conduct)
- [Reporting Issues](#reporting-issues)
- [Submitting Changes](#submitting-changes)
- [Style Guides](#style-guides)
  - [Git Commit Messages](#git-commit-messages)
  - [Code Style](#code-style)
- [Additional Resources](#additional-resources)

### How to Contribute

1. **Fork the repository** and clone it locally.
2. **Create a new branch** based on `main` for your feature or bug fix.
    ```sh
    git checkout -b feature-or-bugfix-name
    ```
3. **Make your changes** with descriptive commit messages.
4. **Push your branch** to your forked repository.
    ```sh
    git push origin feature-or-bugfix-name
    ```
5. **Open a pull request** against the `main` branch of the original repository.

### Code of Conduct

This project and everyone participating in it is governed by the [Contributor Covenant Code of Conduct](https://www.contributor-covenant.org/version/2/0/code_of_conduct.html). By participating, you are expected to uphold this code.

### Reporting Issues

If you find a bug in the source code, you can help by submitting an issue to our [GitHub Repository](https://github.com/deathlotuslabs/cardboard/issues). Even better, you can submit a Pull Request with a fix.

**Please follow these guidelines:**
- **Use a clear and descriptive title** for the issue to identify the problem.
- **Describe the exact steps** to reproduce the problem in as many details as possible.
- **Include any relevant logs or screenshots** to help illustrate the problem.

### Submitting Changes

1. Ensure that your code adheres to the project's coding standards.
2. Update the documentation to reflect any changes.
3. Ensure that the test suite passes (`php artisan test`).
4. Add tests to cover your changes.
5. Make sure your commit messages are clear and descriptive.

### Style Guides

#### Git Commit Messages

- Use the present tense ("Add feature" not "Added feature").
- Use the imperative mood ("Move cursor to..." not "Moves cursor to...").
- Reference issues and pull requests liberally after the first line.

#### Code Style

- Follow the coding style conventions of the project.
- Use consistent indentation.
- Avoid trailing whitespace.
- Ensure code passes all linting and formatting checks.


##### <a id="credits">Credits</a>
Created by <a target="_blank" href="https://x.com/ChristopherLaw_">Christopher Law</a>.

##### Contributors

Thanks to these wonderful people who have contributed to this project:

[![Contributors](https://contrib.rocks/image?repo=DeathLotusLabs/cardboard)](https://github.com/deathlotuslabs/cardboard/graphs/contributors)

#### <a id="support">Support</a>
If you would like to support development please consider sponsoring the project on <a target="_blank" href="https://www.patreon.com/DeathLotusLabs">Patreon</a>
