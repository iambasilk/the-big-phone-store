# Supplier Product List Processor

[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

This is a Supplier Product List Processor written in PHP. It can parse various file formats containing product data, generate unique combinations, and save the results to an output file. This README provides instructions on how to run the application.

## Table of Contents

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Usage](#Usage)
  - [Configuration](#Configuration)

## Getting Started

### Prerequisites

- PHP 7 or higher

### Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/iambasilk/the-big-phone-store.git
   ```

2. Navigate to the project directory:

   ```bash
   cd the-big-phone-store
   ```

### Usage

Execute the parser.php script with the following command, replacing <input_file.csv> with the path to your input file (e.g., products.csv) and <output_file.csv> with the desired output file name (e.g., combinations_count.csv)

```bash
php parser.php --file <input_file.csv> --unique-combinations=<output_file.csv>

```

Example:

```bash
php parser.php --file examples/products_comma_separated.csv --unique-combinations=combination_count.csv
```

```bash
php parser.php --file examples/products_tab_separated.tsv --unique-combinations=combination_count.csv
```

The script will parse the input file, generate unique combinations, and save them to the specified output file.After the script completes, it will display "Parsed Successfully !" to indicate that the parsing process is complete.

### Configuration

You can customize configuration settings such as batch size and file paths by editing the config/Constants.php file.
