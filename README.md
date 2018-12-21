# api-platform-two-apis

PoC that separates DTOs: internal and external.

CLI:
- `IS_INTERNAL=true bin/console api:swag:ex`
- `bin/console api:swag:ex`

API Docs:
- header `x-internal` exists / query string with key `is_internal` any content <-> internal API
- otherwise: external API
