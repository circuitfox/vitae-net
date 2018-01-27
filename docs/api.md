## Introduction

This document contains a list of API endpoints and sample JSON outputs from
them. These are intended to aid in familiarizing oneself with the application
as well as for debugging it. In the tables below, values in curly brackets (like `{id}`)
represent a numeric id. Routes without an `/api/<version>` prefix are internal
and are expected to remain stable across application versions. Internal APIs
always require authentication.

## APIs

### Users

| Route | Method | Description |
|-------|--------|-------------|
| `/users` | GET | Get a list of all the users in the database. |
| `/users/create` | GET | Show the form to add a user to the database. |
| `/users` | POST | Add a user to the database. |
| `/users/{user}` | GET | Retrieve the given user from the database. |
| `/users/{user}/edit` | GET | Show the form to edit a user. |
| `/users/{user}` | PUT/PATCH | Update the user in the database. |
| `/users/{user}` | DELETE | Remove the user from the database. |

### Medications

| Route | Method | Description | Authentication |
|-------|--------|-------------|----------------|
| `/medications` | GET | Get a list of all the medications that can be scanned. | Yes |
| `/medications/create` | GET | Show the form to add a medication to the database. | Yes |
| `/medications` | POST | Add a medication to the database. | Yes |
| `/medications/{medication}` | GET | Retrieve the given medication from the database. | Yes |
| `/medications/{medication}/edit` | GET | Show the form to edit a medication. | Yes |
| `/medications/{medication}` | PUT/PATCH | Update the medication in the database. | Yes |
| `/medications/{medication}` | DELETE | Remove the medication from the database. | Yes |
| `/api/v1/medications/verify` | POST | Verify a medication based on its scanned information, returning an object that either contains a description of the medication, or describes the error that occurred. This route verifies off a QR code. | No |
| `/api/v2/medications/verify` | POST | Verify a medication based on its scanned information, returning an object that either contains a description of the medication, or describes the error that occurred. This route verifies off a barcode. | No |

### Patients

| Route | Method | Description | Authentication |
|-------|--------|-------------|----------------|
| `/patients` | GET | Get a list of all the patients that can be scanned. | Yes |
| `/patients/create` | GET | Show the form to add a patient to the database. | Yes |
| `/patients` | POST | Add a patient to the database. | Yes |
| `/patients/{patient}` | GET | Retrieve the given patient from the database. | Yes |
| `/patients/{patient}/edit` | GET | Show the form to edit a patient. | Yes |
| `/patients/{patient}` | PUT/PATCH | Update the patient in the database. | Yes |
| `/patients/{patient}` | DELETE | Remove the patient from the database. | Yes |
| `/api/v1/patients/verify` | POST | Verify a patient based on its scanned information, returning an object that either contains a description of the patient, or describes the error that occurred. This route verifies off a QR code. | No |
| `/api/v2/patients/verify` | POST | Verify a patient based on its scanned information, returning an object that either contains a description of the patient, or describes the error that occurred. This route verifies off a barcode. | No |

## JSON

The following describe the format of the JSON objects passed to and returned by the given
routes. All elements of the form `$name` are variables that will be filled in
by client code. Some variables may be numbers or booleans in real-world output.

### `/api/v1/medications/verify` - parameters

```json
{
  "name": "$name",
  "dosage": "$dosage",
  "units": "$units",
  "secondary_name": "$secondary_name",
  "second_dosage": "$second_dosage",
  "second_units": "$second_units",
  "second_type": "$second_type",
}
```

### `/api/v1/medications/verify` - response

Success:

```json
{
  "status": "success",
  "data": {
    "name": "$name",
    "dosage": "$dosage",
    "units": "$units",
    "secondary_name": "$secondary_name",
    "second_dosage": "$second_dosage",
    "second_units": "$second_units",
    "second_type": "$second_type",
    "comments": "$comments",
  }
}
```

Failure:

```json
{
  "status": "error",
  "data": "$error"
}
```

### `/api/v1/patients/verify` - parameters

```json
{
  "first_name": "$first_name",
  "last_name": "$last_name",
  "dob": "$dob",
  "mrn": "$mrn"
}
```

### `/api/v1/patients/verify` - response

Success:

```json
{
  "status": "success",
  "data": {
    "first_name": "$first_name",
    "last_name": "$last_name",
    "dob": "$dob",
    "mrn": "$mrn",
    "sex": "$sex",
    "height": "$height",
    "weight": "$weight",
    "diagnosis": "$diagnosis",
    "allergies": "$allergies",
    "code_status": "$code_status",
    "physician": "$physician",
    "room": "$room"
  }
}
```

Failure:

```json
{
  "status": "error",
  "data": "$error"
}
```

### `/api/v2/medications/verify` - parameters

```json
{
  "type": "medication",
  "code": "$code",
}
```

### `/api/v2/medications/verify` - response

Success:

```json
{
  "status": "success",
  "data": {
    "name": "$name",
    "dosage": "$dosage",
    "units": "$units",
    "secondary_name": "$secondary_name",
    "second_dosage": "$second_dosage",
    "second_units": "$second_units",
    "second_type": "$second_type",
    "comments": "$comments",
  }
}
```

Failure:

```json
{
  "status": "error",
  "data": "$error"
}
```

### `/api/v2/patients/verify` - parameters

```json
{
  "type": "patient",
  "code": "$code",
}
```

### `/api/v2/patients/verify` - response

Success:

```json
{
  "status": "success",
  "data": {
    "first_name": "$first_name",
    "last_name": "$last_name",
    "dob": "$dob",
    "mrn": "$mrn",
    "sex": "$sex",
    "height": "$height",
    "weight": "$weight",
    "diagnosis": "$diagnosis",
    "allergies": "$allergies",
    "code_status": "$code_status",
    "physician": "$physician",
    "room": "$room"
  }
}
```

Failure:

```json
{
  "status": "error",
  "data": "$error"
}
```
