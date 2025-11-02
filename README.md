Spreadsheet Translator Symfony Demo Application
================================================

Symfony demo application that takes a Microsoft OneDrive spreadsheet and generates translation files in XLIFF format.

## Requirements

- PHP >= 8.4
- Symfony 7.0
- Docker & Docker Compose (recommended)

## Installation

```bash
composer create-project atico/translator-symfony-demo-onedrive-to-xliff
```

Copy `.env` and configure your OneDrive spreadsheet URL:

```bash
cp .env.example .env
```

Demo spreadsheet: https://onedrive.live.com/embed?resid=F52C4DBF73226B55%%212071&authkey=%%21ANaIXSe9EB_Vywo&em=2&em=2&cid=F52C4DBF73226B55%%212071

Notice that this file can not be opened via web browser but with the atico:demo:translator command.

## Running with Docker

```bash
make build          # Build Docker images
make up             # Start services
make composer-install
make console atico:demo:translator --sheet-name=common
```

## Running Locally

```bash
bin/console atico:demo:translator --sheet-name=common
```

## Output

Translation files are generated in `translations/`:

```
translations/
  ├── demo_common.es_ES.xliff
  ├── demo_common.en_GB.xliff
  └── demo_common.it_IT.xliff
```

## OneDrive File Sharing

1. Open spreadsheet in OneDrive
2. Share → Embed → Generate code
3. Extract AUTHKEY from iframe code
4. Copy RESID and CID from URL
5. Build URL: `https://onedrive.live.com/embed?resid=RESID&authkey=AUTHKEY&em=2&cid=CID`

Note: Escape `%` characters in URL values by doubling them (`%%`)

## Related Projects

- [Symfony Bundle](https://github.com/samuelvi/spreadsheet-translator-symfony-bundle)
- [Local File to PHP Demo](https://github.com/samuelvi/translator-symfony-demo-local-file-to-php)
- [Google Drive to YML Demo](https://github.com/samuelvi/translator-symfony-demo-google-drive-provider-yml-exporter)



## Dependencies

- `samuelvi/spreadsheet-translator-core`: ^8.4
- `samuelvi/spreadsheet-translator-symfony-bundle`: ^8.0
- `samuelvi/spreadsheet-translator-provider-onedrive`: ^8.0
- `samuelvi/spreadsheet-translator-reader-xlsx`: ^8.1
- `samuelvi/spreadsheet-translator-exporter-xliff`: ^8.0


## License

Licensed under the MIT License. See LICENSE file for details.

