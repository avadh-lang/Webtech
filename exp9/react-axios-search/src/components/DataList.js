import React from "react";

function DataList({ data = [] }) {
  return (
    <div className="list-container">
      {data.length > 0 ? (
        data.map((user) => (
          <div className="card" key={user.id}>
            <h3>{user.name}</h3>
            <p><strong>Email:</strong> {user.email}</p>
            <p><strong>Company:</strong> {user.company?.name || "N/A"}</p>
          </div>
        ))
      ) : (
        <p className="no-result">No results found</p>
      )}
    </div>
  );
}

export default DataList;
