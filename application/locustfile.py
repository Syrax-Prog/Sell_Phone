from locust import HttpUser, task, between

class PhoneStoreUser(HttpUser):
    # Bots will wait 1 to 3 seconds between actions to act like real humans
    wait_time = between(1, 3)

    @task(3) # This task is 3x more likely to happen
    def view_homepage(self):
        self.client.get("/")

    @task(1)
    def search_phone(self):
        # This tests your database performance!
        self.client.get("Homepage?query=Galaxy")

    @task(1)
    def view_product(self):
        # Replace 'iphone-15' with a normalized_name that actually exists in your DB
        self.client.get("Homepage")