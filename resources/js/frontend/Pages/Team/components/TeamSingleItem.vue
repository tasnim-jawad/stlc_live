<template>
  <div
    class="col-xl-3 col-lg-4 col-md-6 fadeinup wow"
    style="visibility: visible; animation-name: fadeinup"
  >
    <div
      class="team-card style-2 background-image"
      style="background-image: url('assets/img/shape/team-2-bg-shape.png')"
    >
      <div class="team-img">
        <img src="assets/frontend/img/team/team_2_1.png" alt="Team" />
      </div>
      <div class="team-content">
        <div class="left-contet">
          <h3 class="box-title">
            <a href="team-details.html">Vickie Wisozk</a>
          </h3>
          <span class="team-desig">Real Estate Manager</span>
        </div>
        <div class="team-social">
          <div class="th-social">
            <a target="_blank" href="https://instagram.com/"
              ><i class="fab fa-linkedin-in"></i
            ></a>
            <a target="_blank" href="https://linkedin.com/"
              ><i class="fa-solid fa-envelope"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>

/* Team Card */
.team-card {
  background: #1a1a1a;
  border-radius: 15px;
  overflow: hidden;
  transition: all 0.3s ease;
  cursor: pointer;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.team-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
  border-color: #22c55e;
}

.card-image {
  position: relative;
  aspect-ratio: 4/3;
  overflow: hidden;
}

.member-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.team-card:hover .member-image {
  transform: scale(1.05);
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
  display: flex;
  align-items: flex-end;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  padding: 1rem;
}

.team-card:hover .image-overlay {
  opacity: 1;
}

.social-links {
  display: flex;
  gap: 0.5rem;
}

.social-link {
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  border-radius: 50%;
  color: white;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.social-link:hover {
  background: #22c55e;
  transform: scale(1.1);
}

.card-content {
  padding: 1.5rem;
}

.member-name {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: #ffffff;
}

.member-designation {
  color: #22c55e;
  font-weight: 500;
  margin-bottom: 1rem;
}

.view-profile-btn {
  width: 100%;
  padding: 0.75rem;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
}

.view-profile-btn:hover {
  background: linear-gradient(135deg, #16a34a, #15803d);
  transform: translateY(-2px);
}

/* List View Specific Styles */
.team-grid.list .team-card {
  display: flex;
  flex-direction: row;
  height: 200px;
}

.team-grid.list .card-image {
  width: 300px;
  flex-shrink: 0;
}

.team-grid.list .card-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 2rem;
}

.team-grid.list .member-designation {
  margin-bottom: 1.5rem;
}

.team-grid.list .view-profile-btn {
  width: auto;
  padding: 0.5rem 1.5rem;
  align-self: flex-start;
}

/* Pagination */
.pagination-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
}

.pagination {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.pagination-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: #2a2a2a;
  color: #ffffff;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 500;
}

.pagination-btn:hover:not(:disabled) {
  background: #22c55e;
  border-color: transparent;
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.pagination-numbers {
  display: flex;
  gap: 0.5rem;
}

.pagination-number {
  width: 40px;
  height: 40px;
  background: #2a2a2a;
  color: #ffffff;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 500;
}

.pagination-number:hover,
.pagination-number.active {
  background: #22c55e;
  border-color: transparent;
}

.pagination-info {
  color: #b0b0b0;
  font-size: 0.9rem;
}

/* Modal */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.9);
  backdrop-filter: blur(10px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 2rem;
  overflow-y: auto;
}

.modal-content {
  position: relative;
  max-width: 800px;
  width: 100%;
  background: #1a1a1a;
  border-radius: 15px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  max-height: 90vh;
  overflow-y: auto;
}

.modal-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  width: 40px;
  height: 40px;
  background: rgba(0, 0, 0, 0.7);
  border: none;
  border-radius: 50%;
  color: white;
  font-size: 1.2rem;
  cursor: pointer;
  z-index: 1001;
  transition: all 0.3s ease;
}

.modal-close:hover {
  background: #22c55e;
}

.modal-body {
  padding: 2rem;
}

.modal-header {
  display: flex;
  gap: 2rem;
  margin-bottom: 2rem;
  align-items: center;
}

.modal-image {
  flex-shrink: 0;
}

.profile-image {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #22c55e;
}

.modal-info {
  flex: 1;
}

.profile-name {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  color: #ffffff;
}

.profile-designation {
  color: #22c55e;
  font-size: 1.2rem;
  font-weight: 500;
  margin-bottom: 1.5rem;
}

.modal-social-links {
  display: flex;
  gap: 1rem;
}

.modal-social-link {
  width: 45px;
  height: 45px;
  background: #2a2a2a;
  border-radius: 50%;
  color: #b0b0b0;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-social-link:hover {
  background: #22c55e;
  color: white;
  border-color: transparent;
}

.modal-details {
  display: grid;
  gap: 2rem;
}

.detail-section h4 {
  color: #22c55e;
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 1rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  padding-bottom: 0.5rem;
}

.detail-section p {
  color: #b0b0b0;
  line-height: 1.6;
  margin: 0;
}

.contact-links {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.contact-link {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  background: #2a2a2a;
  border-radius: 8px;
  color: #b0b0b0;
  text-decoration: none;
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.contact-link:hover {
  background: #22c55e;
  color: white;
  border-color: transparent;
  transform: translateX(5px);
}

.contact-link i {
  width: 20px;
  font-size: 1.1rem;
}

.contact-link span {
  font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
  
}

@media (max-width: 480px) {
  .container {
    padding: 0 0.75rem;
  }

  .page-title {
    font-size: 1.8rem;
  }

  .filter-btn {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
  }

  .team-grid.grid {
    grid-template-columns: 1fr;
  }

  .card-content {
    padding: 1rem;
  }

  .modal-overlay {
    padding: 1rem;
  }

  .modal-body {
    padding: 1.5rem;
  }

  .profile-image {
    width: 120px;
    height: 120px;
  }

  .profile-name {
    font-size: 1.5rem;
  }
}
</style>

