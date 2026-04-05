import React, { useEffect, useState } from "react";
import { getUsers } from "./services/api";
import SearchBar from "./components/SearchBar";
import DataList from "./components/DataList";

function App() {
const [users, setUsers] = useState([]);
const [searchTerm, setSearchTerm] = useState("");
const [loading, setLoading] = useState(true);
const [error, setError] = useState("");

// Fetch data using Axios
useEffect(() => {
getUsers()
.then((response) => {
setUsers(response.data);
setLoading(false);
})
.catch(() => {
setError("Error fetching data");
setLoading(false);
});
}, []);

// Search filter
const filteredUsers = users.filter((user) =>
user.name.toLowerCase().includes(searchTerm.toLowerCase())
);

return (
  <div className="app-container">
    <header className="hero">
      <p className="eyebrow">User Directory</p>
      <h1>React Axios Search App</h1>
      <p className="hero-text">
        Search through fetched user profiles and quickly find names, emails,
        and company details.
      </p>
    </header>

    <section className="search-panel">
      <SearchBar
        searchTerm={searchTerm}
        setSearchTerm={setSearchTerm}
      />
    </section>

    {loading && <p className="status">Loading...</p>}
    {error && <p className="error">{error}</p>}

    {!loading && !error && (
      <DataList data={filteredUsers} />
    )}
  </div>
);
}

export default App;
