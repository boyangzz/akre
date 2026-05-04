# AKRE - AI Assistant Guide

This project is a CodeIgniter 3 application for BAN-PT Accreditation Management.

## Available Tools
- **Context7 MCP**: Use this tool to fetch documentation for libraries (e.g., CodeIgniter 3, PHPSpreadsheet, DomPDF).
  - Usage: `use context7` or query specific libraries.

## Coding Standards
- **Framework**: CodeIgniter 3 (MVC).
- **PHP Version**: 7.4/8.x compatible.
- **Frontend**: Bootstrap 5, jQuery 3.7.1, Bootstrap Icons.
- **Security**: 
  - Always use `MY_Controller` for auth guard.
  - Implement CSRF protection (Phase 9 objective).
  - Use Layered Validation (DB -> Backend -> Frontend).

## Project Structure
- `application/controllers/`: Business logic.
- `application/models/`: Data access.
- `application/views/`: UI templates (split into `layout/header` and `layout/footer`).
- `assets/`: Local assets (Zero-CDN policy).

## Knowledge References
- Refer to `erd.md` for database schema.
- Refer to `progress.md` for current task status.
- Refer to `implementation_plan_*.md` for feature roadmaps.
