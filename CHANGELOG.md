# Changelog

This project adheres to [semantic versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased
### Fixed
- MAR scanning status is now checked for med id, and initials are used in place
  of checks
## [0.8.0] - 2019-03-12
### Added
- Changing the patient for orders or labs is broadcast as an event and
  shown to users without needing refreshing
- Redis queue for event broadcasting
- laravel-echo-server for websockets and event propagation to users

## [0.7.3] - 2019-01-31
### Fixed
- The signature submit form is shown again after scanning medication
- Patient MARs are updated to provide feedback when signatures are submitted
- Bump copyright date
