## REST API CRUD DOCUMENTATION
## Report Table - Siaga Bencana

### Base URL
```
http://localhost:8000/api/v1
```

---

## ENDPOINTS

### 1. GET All Reports
**Endpoint:** `GET /reports`

**Description:** Retrieve all reports with filtering and pagination support.

**Query Parameters:**
- `per_page` (integer): Items per page, default 20
- `disaster_type` (string): Filter by disaster type
- `disaster_status` (string): Filter by disaster status (Terjadi, Prediksi, Selesai)
- `source` (string): Filter by source (BUMN, PetaBencana, USGS, etc.)
- `location` (string): Search by location (partial match)

**Example Request:**
```
GET /api/v1/reports?per_page=10&disaster_status=Terjadi&source=BUMN
```

**Response (Success - 200):**
```json
{
  "status": "success",
  "message": "Reports retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "Gempa Bumi 6.5 - Jawa Timur",
      "disaster_type": "Gempa Bumi",
      "location": "Surabaya, Jawa Timur",
      "latitude": -7.2575,
      "longitude": 112.7521,
      "report_date": "2026-05-08",
      "description": "Gempa berkekuatan 6.5 SR mengguncang Jawa Timur",
      "status": "Diverifikasi",
      "disaster_status": "Terjadi",
      "source": "BUMN"
    }
  ],
  "pagination": {
    "total": 45,
    "per_page": 10,
    "current_page": 1,
    "last_page": 5
  }
}
```

---

### 2. POST Create New Report
**Endpoint:** `POST /reports`

**Description:** Create a new disaster report.

**Request Body:**
```json
{
  "title": "Banjir di Jawa Barat",
  "disaster_type": "Banjir",
  "location": "Bandung, Jawa Barat",
  "report_date": "2026-05-08",
  "description": "Banjir akibat hujan lebat selama 6 jam berturut-turut",
  "latitude": -6.9175,
  "longitude": 107.6191,
  "disaster_status": "Terjadi",
  "status": "Diproses",
  "goal_amount": 500000000,
  "prediction_percentage": 0
}
```

**Response (Success - 201):**
```json
{
  "status": "success",
  "message": "Report created successfully",
  "data": {
    "id": 46,
    "title": "Banjir di Jawa Barat",
    "disaster_type": "Banjir",
    "location": "Bandung, Jawa Barat",
    "latitude": -6.9175,
    "longitude": 107.6191,
    "report_date": "2026-05-08",
    "description": "Banjir akibat hujan lebat selama 6 jam berturut-turut",
    "status": "Diproses",
    "disaster_status": "Terjadi",
    "source": "API",
    "created_at": "2026-05-08T10:30:00Z",
    "updated_at": "2026-05-08T10:30:00Z"
  }
}
```

**Response (Validation Error - 422):**
```json
{
  "status": "error",
  "message": "Validation failed",
  "errors": {
    "title": ["The title field is required."],
    "disaster_type": ["The disaster_type field is required."]
  }
}
```

---

### 3. GET Single Report
**Endpoint:** `GET /reports/{id}`

**Description:** Retrieve a specific report by ID.

**Example Request:**
```
GET /api/v1/reports/1
```

**Response (Success - 200):**
```json
{
  "status": "success",
  "message": "Report retrieved successfully",
  "data": {
    "id": 1,
    "title": "Gempa Bumi 6.5 - Jawa Timur",
    "disaster_type": "Gempa Bumi",
    "location": "Surabaya, Jawa Timur",
    "latitude": -7.2575,
    "longitude": 112.7521,
    "report_date": "2026-05-08",
    "description": "Gempa berkekuatan 6.5 SR mengguncang Jawa Timur",
    "status": "Diverifikasi",
    "disaster_status": "Terjadi",
    "source": "BUMN",
    "created_at": "2026-05-01T08:00:00Z",
    "updated_at": "2026-05-01T08:00:00Z"
  }
}
```

**Response (Not Found - 404):**
```json
{
  "status": "error",
  "message": "Report not found"
}
```

---

### 4. PUT Update Report
**Endpoint:** `PUT /reports/{id}`

**Description:** Update an existing report (partial update allowed).

**Request Body (Only fields to update):**
```json
{
  "disaster_status": "Selesai",
  "goal_amount": 750000000
}
```

**Response (Success - 200):**
```json
{
  "status": "success",
  "message": "Report updated successfully",
  "data": {
    "id": 1,
    "title": "Gempa Bumi 6.5 - Jawa Timur",
    "disaster_status": "Selesai",
    "goal_amount": 750000000,
    "updated_at": "2026-05-08T15:45:00Z"
  }
}
```

---

### 5. DELETE Remove Report
**Endpoint:** `DELETE /reports/{id}`

**Description:** Delete a report from database.

**Example Request:**
```
DELETE /api/v1/reports/1
```

**Response (Success - 200):**
```json
{
  "status": "success",
  "message": "Report deleted successfully",
  "data": {
    "id": 1,
    "deleted_at": "2026-05-08T16:00:00Z"
  }
}
```

---

### 6. GET Reports by Disaster Type
**Endpoint:** `GET /reports/type/{type}`

**Description:** Get all reports for a specific disaster type.

**Example Request:**
```
GET /api/v1/reports/type/Gempa Bumi
```

**Response (Success - 200):**
```json
{
  "status": "success",
  "message": "Reports of type 'Gempa Bumi' retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "Gempa Bumi 6.5 - Jawa Timur",
      "disaster_type": "Gempa Bumi",
      "location": "Surabaya, Jawa Timur"
    }
  ],
  "pagination": {
    "total": 12,
    "per_page": 20,
    "current_page": 1,
    "last_page": 1
  }
}
```

---

### 7. GET Active Reports
**Endpoint:** `GET /reports/status/active`

**Description:** Retrieve only active/ongoing disaster reports with coordinates.

**Example Request:**
```
GET /api/v1/reports/status/active
```

**Response (Success - 200):**
```json
{
  "status": "success",
  "message": "Active reports retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "Gempa Bumi 6.5 - Jawa Timur",
      "disaster_type": "Gempa Bumi",
      "disaster_status": "Terjadi",
      "latitude": -7.2575,
      "longitude": 112.7521,
      "location": "Surabaya, Jawa Timur"
    }
  ],
  "pagination": {
    "total": 8,
    "per_page": 20,
    "current_page": 1,
    "last_page": 1
  }
}
```

---

### 8. GET Statistics Overview
**Endpoint:** `GET /statistics/overview`

**Description:** Get comprehensive statistics about all reports.

**Example Request:**
```
GET /api/v1/statistics/overview
```

**Response (Success - 200):**
```json
{
  "status": "success",
  "message": "Statistics retrieved successfully",
  "data": {
    "total_reports": 156,
    "active_reports": 12,
    "completed_reports": 98,
    "predicted_reports": 46,
    "by_type": [
      {
        "disaster_type": "Gempa Bumi",
        "count": 78
      },
      {
        "disaster_type": "Banjir",
        "count": 45
      },
      {
        "disaster_type": "Tanah Longsor",
        "count": 33
      }
    ],
    "by_status": [
      {
        "disaster_status": "Terjadi",
        "count": 12
      },
      {
        "disaster_status": "Selesai",
        "count": 98
      },
      {
        "disaster_status": "Prediksi",
        "count": 46
      }
    ],
    "by_source": [
      {
        "source": "BUMN",
        "count": 89
      },
      {
        "source": "PetaBencana",
        "count": 34
      },
      {
        "source": "USGS",
        "count": 23
      },
      {
        "source": "API",
        "count": 10
      }
    ]
  }
}
```

---

## ERROR RESPONSES

### 400 Bad Request
```json
{
  "status": "error",
  "message": "Invalid request parameters"
}
```

### 422 Unprocessable Entity (Validation Error)
```json
{
  "status": "error",
  "message": "Validation failed",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

### 404 Not Found
```json
{
  "status": "error",
  "message": "Report not found"
}
```

### 500 Internal Server Error
```json
{
  "status": "error",
  "message": "Failed to process request",
  "error": "Exception message details"
}
```

---

## HTTP STATUS CODES

| Code | Meaning |
|------|---------|
| 200 | OK - Request successful |
| 201 | Created - Resource created successfully |
| 400 | Bad Request - Invalid parameters |
| 404 | Not Found - Resource doesn't exist |
| 422 | Unprocessable Entity - Validation failed |
| 500 | Internal Server Error - Server error |

---

## TESTING WITH CURL

### List all reports
```bash
curl -X GET "http://localhost:8000/api/v1/reports" \
  -H "Accept: application/json"
```

### Create new report
```bash
curl -X POST "http://localhost:8000/api/v1/reports" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Test Report",
    "disaster_type": "Banjir",
    "location": "Jakarta",
    "report_date": "2026-05-08",
    "description": "Test disaster report",
    "disaster_status": "Terjadi"
  }'
```

### Get single report
```bash
curl -X GET "http://localhost:8000/api/v1/reports/1" \
  -H "Accept: application/json"
```

### Update report
```bash
curl -X PUT "http://localhost:8000/api/v1/reports/1" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "disaster_status": "Selesai"
  }'
```

### Delete report
```bash
curl -X DELETE "http://localhost:8000/api/v1/reports/1" \
  -H "Accept: application/json"
```

### Get active reports
```bash
curl -X GET "http://localhost:8000/api/v1/reports/status/active" \
  -H "Accept: application/json"
```

### Get statistics
```bash
curl -X GET "http://localhost:8000/api/v1/statistics/overview" \
  -H "Accept: application/json"
```

---

## VALIDATION RULES

| Field | Rule | Example |
|-------|------|---------|
| title | required, string, max 255 | "Banjir Jakarta" |
| disaster_type | required, string, max 255 | "Banjir" |
| location | required, string, max 255 | "Jakarta, DKI Jakarta" |
| report_date | required, date | "2026-05-08" |
| description | required, string | "Long description..." |
| latitude | nullable, numeric, -90 to 90 | -6.2088 |
| longitude | nullable, numeric, -180 to 180 | 106.8456 |
| disaster_status | nullable, in: Terjadi, Prediksi, Selesai | "Terjadi" |
| status | nullable, in: Diproses, Diverifikasi, Selesai | "Diproses" |
| goal_amount | nullable, numeric, min 0 | 500000000 |
| prediction_percentage | nullable, integer, 0-100 | 75 |

---

## IMPLEMENTATION NOTES

1. **API Version**: All endpoints use `/api/v1/` prefix for versioning
2. **Authentication**: Currently open to public (no authentication required)
3. **Response Format**: All responses use consistent JSON structure
4. **Pagination**: Default 20 items per page, customizable via `per_page` parameter
5. **Filters**: Case-sensitive for exact match, case-insensitive for location search
6. **Coordinates**: Both latitude and longitude must be provided together for map display
7. **Source**: Auto-set to "API" for reports created via this API

---

## FILES CREATED

1. **Controller**: `app/Http/Controllers/Api/ReportApiController.php`
   - 8 public methods for CRUD + custom filters
   - Comprehensive error handling
   - JSON response formatting

2. **Routes**: `routes/api.php`
   - 8 routes for all CRUD operations
   - RESTful URL structure
   - Grouped under `/api/v1/` prefix

---

Generated: 2026-05-08
API Version: 1.0.0
