# Product Inventory Microservice

A robust and scalable Laravel-based microservice for managing product inventory, featuring high-performance caching, database locking for stock integrity, and comprehensive testing.

## 🛠 Project Architecture

<img width="1282" height="759" alt="image" src="https://github.com/user-attachments/assets/d1b9beb7-cef5-436c-8e22-f16e55ea6f8a" />


## 🚀 API Documentation

- **local URL:** [http://localhost:8000](http://localhost:8000)
- **Built with:** [Scramble](https://scramble.dedoc.co/) for automatic OpenAPI documentation.
<img width="1906" height="929" alt="image" src="https://github.com/user-attachments/assets/6655fb9f-b22b-46a4-80e8-a5a3df44b83c" />



------

## 🐳  API Documentation

<img width="1920" height="1048" alt="image" src="https://github.com/user-attachments/assets/39426604-e155-4dc1-9a46-b04e17b36894" />


------



## 🏗 Folder Structure

The `app/` directory follows a clean, layered architecture:
- **`Enums/`**: Static enumerations (e.g., product status).
- **`Events/v1/`**: Event classes for inventory alerts.
- **`Exceptions/`**: Custom exception handling.
- **`Http/`**:
    - **`Controllers/v1/`**: Versioned API controllers.
    - **`Dtos/v1/`**: Data Transfer Objects for clean data handling.
    - **`Requests/v1/`**: Request validation logic.
    - **`Resources/v1/`**: API transformation layers.
    - **`Responses/v1/`**: Standardized response formats.
- **`Listeners/v1/`**: Logic executed in response to events.
- **`Models/`**: Eloquent models (Product, User).
- **`Observers/v1/`**: Model lifecycle event handlers.
- **`Providers/`**: Service providers and container bindings.
- **`repositories/v1/`**: Repository pattern for database abstraction.
- **`services/v1/`**: Service layer for business logic.
- **`database/migrations`**: Schema definitions.
- **`tests/Feature`**: API and stock management feature tests.

---

## 🛠 Advanced Techniques
### ⚡ Caching
- **Implementation:** Uses **Redis** with Cache Tags (`products`).
- **Benefit:** Optimized product listing by caching paginated results for 10 minutes, significantly reducing database load.
- **Location:** [ProductService.php](app/services/v1/product/ProductService.php)

### 📄 Pagination
- **Implementation:** Integrated into both Product and Stock repositories.
- **Benefit:** Handles large datasets efficiently by serving 10 items per page (configurable).
- **Location:** [ProductRepository.php](app/repositories/v1/product/ProductRepository.php)

### 🔒 Pessimistic Locking
- **Implementation:** Uses `DB::transaction` with `lockForUpdate()` during stock adjustments.
- **Benefit:** Prevents race conditions (e.g., two concurrent sales trying to update the same product's stock simultaneously), ensuring data integrity.
- **Location:** [StockRepository.php](app/repositories/v1/stock/StockRepository.php)

---

## 🛤 API Endpoints
### Products
- `GET /api/v1/product`: List all products (Cached & Paginated).
- `GET /api/v1/product/{id}`: Fetch a specific product.
- `POST /api/v1/product`: Create a new product.
- `PUT /api/v1/product/{id}`: Update product details.
- `DELETE /api/v1/product/{id}`: Soft delete a product.

### Stock Management
- `PUT /api/v1/stock/{id}/stock`: Adjust product stock quantity (Pessimistic Locking).
- `GET /api/v1/stock/low-stock`: List products below their low-stock threshold (Paginated).

---

## 🧪 Testing

The project includes a full suite of feature tests to ensure API reliability:
- **Products:** `CreateProductTest`, `GetProductTest`, `UpdateProductTest`, `DeleteProductTest`.
- **Stock:** `StockTest` (covers stock adjustment and threshold alerts).
- **Continuous Integration:**  (Automated Test Cases Using Github Actions).

Run tests inside the container:
```bash
docker-compose exec inventory-app php artisan test
```

---

## ⚙️ Installation & Setup
Follow these steps to get the project running locally using **Docker Desktop**:

1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd Product_Inventory_microservice
   ```

2. **Environment Setup:**
   ```bash
   cp .env.example .env
   ```

3. **Start Containers:**
   
   ```bash
   docker-compose up -d --build
   ```
   
4. **Install PHP Dependencies:**
   ```bash
   docker-compose exec inventory-app composer install
   ```

5. **Generate App Key:**
   ```bash
   docker-compose exec inventory-app php artisan key:generate
   ```

6. **Database Migration & Seeding:**
   ```bash
   docker-compose exec inventory-app php artisan migrate --seed
   ```

7. **Access the App:**
   
   - **Website:** [http://localhost:8000/api/v1/products/](http://localhost:8000/api/v1/products/)
   - **API Docs:** [http://localhost:8000/docs](http://localhost:8000/docs)
